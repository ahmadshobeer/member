<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MMember extends Model
{
    use HasFactory;
    protected $table = 'm_pelanggan';

    public function member()
    {
        return $this->belongsTo(User::class, 'no_pelanggan', 'no_pelanggan');
    }
}
