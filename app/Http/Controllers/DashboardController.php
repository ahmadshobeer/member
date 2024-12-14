<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function index(){
        $user = Auth::user();
        $pelanggan = $user->pelanggan; // Ambil data pelanggan yang terkait

        return view('/dashboard', [
            'user' => $user,
            'nm_pelanggan' => $pelanggan ? $pelanggan->nama : null,
        ]);
    }
}
