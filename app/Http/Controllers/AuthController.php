<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Validator;

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
   /*  public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'phone' => 'required',
            'password' => 'required',
        ]);

        // Ambil data dari form
        $credentials = $request->only('phone', 'password');

        // Cek kredensial
        if (Auth::attempt($credentials)) {
            // Ambil user yang sedang login
            $user = Auth::user();

            // Ambil data pelanggan terkait
            $member = $user->member;

            // Redirect atau tampilkan data
            return view('/', [
                'user' => $user,
                'member' => $member,
            ]);
        }

        // Jika login gagal
        return redirect()->back()->withErrors(['phone' => 'Invalid credentials.']);
    } */
}
