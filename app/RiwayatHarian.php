<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class RiwayatHarian extends Model
{
    protected $fillable = ['produk_id', 'riwayat_bulanan_id', 'user_id', 'jumlah_produk','jumlah_harga_produk','jumlah_keuntungan'];

    public function produk(){
        return $this->belongsTo(Produk::class);
    }
    
    public function riwayat_bulanan(){
        return $this->belongsTo(RiwayatBulanan::class);
    }

    public function getCreatedAtAttribute()
{
    return Carbon::parse($this->attributes['created_at'])
       ->format('H-M-Y');
}

public function getUpdatedAtAttribute()
{
    return Carbon::parse($this->attributes['updated_at'])
       ->diffForHumans();
}
}
