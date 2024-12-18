<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MPembayaran extends Model
{
    use HasFactory;
    protected $table = 't_pembayaran'; // Tabel yang digunakan
    protected $primaryKey = 'no_transaksi'; // ID utama, jika menggunakan kolom lain selain 'id'

     // Mendapatkan tagihan terakhir berdasarkan pengguna yang sedang login
     /* public static function historyPaymentForUser($user)
     {
         return self::where('no_pelanggan', $user->no_pelanggan)
                     ->latest('tgl'); // Mengambil tagihan terakhir berdasarkan tanggal
                     
     } */

   /*    // Relasi ke MTagihan (jika diperlukan)
    public function tagihan()
    {
        return $this->belongsTo(MTagihan::class, 'no_pelanggan', 'no_pelanggan');
    } */
}
