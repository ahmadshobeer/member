<?php

namespace App\Http\Controllers;

use App\Models\MPembayaran;
use App\Models\MTagihan;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Symfony\Component\VarDumper\VarDumper;

class DashboardController extends Controller
{
    //
    public function index(){
        $user = Auth::user();
        $pelanggan = $user->pelanggan; // Ambil data pelanggan yang terkait

        $tagihan = MTagihan::getLastBillForUser($user);
        $paymentHistory = MPembayaran::where('no_pelanggan', $user->no_pelanggan)
        ->orderBy('tgl', 'asc') // Mengurutkan berdasarkan tanggal pembayaran
        ->get();

        // $pembayaran = MPembayaran::historyPaymentForUser($user);

        // var_dump($paymentHistory);
         if($tagihan->terbayar=="Y"){
            $sts_bayar = "TERBAYAR";
        }else{
            $sts_bayar = "BELUM TERBAYAR";
   
        } 
        return view('/dashboard', [
            'user' => $user,
            'tagihan' => $tagihan,
            'sts_bayar' => $sts_bayar,
            'pembayaran' => $paymentHistory,
            'nm_pelanggan' => $pelanggan ? $pelanggan->nama : null,
        ]);
    }
}
