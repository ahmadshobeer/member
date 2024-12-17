<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MTarif extends Model
{
    use HasFactory;
    protected $table = 'm_paket';
    protected $fillable = ['nm_paket', 'harga'];

    /* public function pelanggan()
    {
        return $this->belongsTo(MMember::class, 'kd_paket', 'kd_paket');
        // return $this->hasOne(MMember::class);
    } */

    public function pelanggans()
    {
        return $this->hasMany(Pelanggan::class, 'kd_paket');
    }
}
