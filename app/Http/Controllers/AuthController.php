<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;

class AuthController extends Controller
{
    //

    public function index()
    {
        return view('auth.login');
    } 

    public function postLogin(Request $request){
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'password' => 'required'
        ]);
        $remember = $request->has('remember'); // True jika checkbox 'remember me' dicentang


        if($validator->fails()){
            return response()->json([
                "status" => false,
                "errors" => $validator->errors()
            ]);
        }else{
            if(Auth::attempt($request->only(['phone','password'],$remember))){
                return response()->json([
                    "status" => true, 
                    "redirect" => url("/dashboard")
                ]);
            }else{
                return response()->json([
                    "status" => false,
                    "errors" => ["Invalid credentials"]
                ]);
            }
        }
    } 

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'], // Validasi password saat ini
            'new_password' => ['required', 'min:5', 'confirmed'],   // Validasi password baru
        ]);

        // Update password pengguna
        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('my-account')->with('success', 'Password berhasil diubah.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/auth/login');
    }

    public function resetForm()
    {
        return view('auth.reset-password');
    } 

    public function forgotPassword(Request $request){
       /*  $request->validate(['phone' => 'required']);
     
        $status = Password::sendResetLink(
            $request->only('phone')
        );
     
        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['phone' => __($status)]); */

                    $validator = Validator::make($request->all(), [
                        'phone' => 'required|numeric|min:10',
                    ]);
            
                    if ($validator->fails()) {
                        return redirect()->back()->withErrors($validator)->withInput();
                    }
            
                    // Mencari user berdasarkan no_hp
                    $user = User::where('phone', $request->phone)->first();
            
                    if (!$user) {
                        return back()->with('error', 'Nomor HP tidak ditemukan.');
                    }
            
                    // Kirimkan link reset password
                    $response = Password::sendResetLink(
                        ['email' => $user->email]
                    );
            
                    if ($response == Password::RESET_LINK_SENT) {
                        return back()->with('status', 'Link reset password telah dikirim ke email Anda.');
                    } else {
                        return back()->withErrors(['email' => 'Terjadi kesalahan saat mengirimkan email reset password.']);
                    }
                
    }

    public function resetPassword (Request $request){
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);
     
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
     
                $user->save();
     
                event(new PasswordReset($user));
            }
        );
     
        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }
  
}
