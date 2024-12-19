<?php

namespace App\Http\Controllers;

use App\Models\MApp;
use App\Models\MPasswordResetToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use GuzzleHttp\Client; 
// use GuzzleHttp\Psr7\Request;

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
            'new_password' => ['required', 'min:6', 'confirmed'],   // Validasi password baru
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



   

    public function forgotPassword(Request $request){
        $validator = Validator::make($request->all(), [
            'phone' => 'required|numeric|min:10',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $noHp = $request->input('phone');
        $user = User::where('phone', $request->phone)->first();
            
        if ($user) {

            // Generate token baru
            $token = Str::random(60);

            // Simpan token dan nomor telepon dalam tabel password_reset_token
            MPasswordResetToken::create([
                'phone' => $noHp,
                'token' => $token,
            ]);

            // Membuat URL reset password yang berisi token
            $resetUrl = url('/password-reset-form?token=' . $token.'&phone='.$noHp);

        

            // Mengirimkan URL melalui Guzzle HTTP Client
        $send= $this->sendWithGuzzle($noHp, $resetUrl);

      
        if($send){
            return back()->with('status', 'Link reset password telah dikirim ke nomer '.$noHp.'.');
        }else{
            return back()->with('error', 'Error saat mengirim link, hubungi Admin.');
        }
        /* return response()->json([
            'message' => 'Link reset password telah dikirim.',
        ]); */

            
        }else{
            return back()->withErrors(['error' => 'Nomor HP tidak ditemukan.']);


        }

      
    }

    private function sendWithGuzzle($noHp,$resetUrl){
        $client = new Client();

    //   $token = MApp::pluck('token_wa'); 
      $token = MApp::where('id', '1')->value('token_wa');
        //  $token = env('WA_TOKEN'); 
       // var_dump($token);
        $headers = [
            'Authorization' => $token
        ]; 

        $options = [
        'headers' => $headers, 
        'multipart' => [
            [
            'name' => 'target',
            'contents' => "$noHp|$resetUrl",
            ],
            [
            'name' => 'message',
            'contents' => "Halo, klik link berikut untuk reset password member anda \n$resetUrl. Balas dengan *Ya* agar link bisa diklik."
            ]
        ]];

          try{

           
            $response = $client->post('https://api.fonnte.com/send', $options);

              if ($response->getStatusCode() == 200) {
                // Respons sukses
                return back()->with('status', 'Link reset password telah dikirim ke no WA anda Anda.');;
            }

            // Jika status code tidak 200, bisa memproses error di sini
            return false;

          }catch(\Exception $e){
             // Menangani kesalahan saat mengirim permintaan
            // Misalnya, log kesalahan atau tampilkan pesan error
            \Log::error('Guzzle Error: ' . $e->getMessage());
            return false;
          }
    }


    public function showResetForm(Request $request)
    {
          // Verifikasi token di URL
          $token = $request->query('token');
          $no_hp = $request->query('phone');
  
          
        // Cek apakah token valid dan nomor telepon ada di tabel password_reset_token
        // $resetToken = MPasswordResetToken::where('token', $token)->where('phone', $no_hp)->first();
        // Cek apakah token valid dan belum kadaluarsa (valid selama 1 jam)
        $resetToken = MPasswordResetToken::where('token', $token)
            ->where('phone', $no_hp)
            ->where('created_at', '>', now()->subHours(1)) // Token hanya valid selama 1 jam
            ->first();

        // Jika token valid, tampilkan form reset password
        if ($resetToken) {
            return view('auth.reset-password', compact('token', 'no_hp'));
        } else {
            // Jika token tidak valid atau sudah kadaluarsa, arahkan ke halaman login dengan pesan error
            return redirect()->route('login')->withErrors(['error' => 'Token tidak valid atau sudah kadaluarsa.']);
        }

        if ($resetToken) {
            return view('auth.reset-password', compact('token', 'phone'));
        } else {
            return redirect()->route('login')->withErrors(['error' => 'Token tidak valid atau sudah kadaluarsa.']);
        }
    } 

   public function resetPassword (Request $request){
        $request->validate([
            'phone' => 'required|numeric|exists:users,phone',
            'password' => 'required|min:6|confirmed',
        ]);
     
        $user = User::where('phone', $request->phone)->first();

        
        // Set password baru
        $user->password = Hash::make($request->password); // Enkripsi password

        // Simpan perubahan password
        $user->save();

        // Hapus token reset password setelah berhasil reset
        MPasswordResetToken::where('phone', $request->phone)->delete();

        return redirect()->route('login')->with('status', 'Password Anda telah berhasil diubah.');
    
    } 
  
}
