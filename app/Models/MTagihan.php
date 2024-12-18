<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MTagihan extends Model
{
    use HasFactory;
    protected $table = 't_tagihan'; // Tabel yang digunakan
    protected $primaryKey = 'no_trans'; // ID utama, jika menggunakan kolom lain selain 'id'


    public function user()
    {
        return $this->belongsTo(User::class, 'no_pelanggan', 'no_pelanggan');
    }

     // Mendapatkan tagihan terakhir berdasarkan pengguna yang sedang login
     public static function getLastBillForUser($user)
     {
         return self::where('no_pelanggan', $user->no_pelanggan)
                     ->latest('tgl') // Mengambil tagihan terakhir berdasarkan tanggal
                     ->first();
     }

    /*  public function pembayaran()
     {
         return $this->hasMany(MPembayaran::class, 'no_pelanggan', 'no_pelanggan');
     } */

}
