<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //
   /*  public function index()
    {
        return view('profile');
    }  */
    public function index()
    {
        $user = Auth::user();
        $pelanggan = $user->pelanggan; // Ambil data pelanggan yang terkait

        return view('profile', [
            'user' => $user,
            'nm_pelanggan' => $pelanggan ? $pelanggan->nama : null,
        ]);
    }

}
