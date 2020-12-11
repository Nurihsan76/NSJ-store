<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = ['nama', 'modal', 'harga', 'jumlah', 'keuntungan', 'user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function riwayatharian(){
        return $this->hasMany(RiwayatHarian::class);
    }
}
