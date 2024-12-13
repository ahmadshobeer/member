<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
                    "redirect" => url("/")
                ]);
            }else{
                return response()->json([
                    "status" => false,
                    "errors" => ["Invalid credentials"]
                ]);
            }
        }
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
