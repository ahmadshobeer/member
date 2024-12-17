<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MMember extends Model
{
    use HasFactory;
    protected $table = 'm_pelanggan';

   /*  public function member()
    {
        return $this->belongsTo(User::class, 'no_pelanggan', 'no_pelanggan');
    }


    public function tarif_member()
    {
        return $this->hasOne(MTarif::class, 'kd_paket', 'kd_paket');
        // return $this->belongsTo(MTarif::class, 'kd_paket', 'kd_paket');
    } */


    public function tarif()
    {
        return $this->belongsTo(MTarif::class, 'kd_paket','kd_paket');
    }

    // Relasi Pelanggan dengan User
    public function user()
    {
        return $this->belongsTo(User::class, 'no_pelanggan', 'no_pelanggan');
    }
}
