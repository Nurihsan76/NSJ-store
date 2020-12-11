<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RiwayatBulanan extends Model
{
    protected $fillable = ['user_id', 'tanggal', 'pemasukan_hari_ini', 'keuntungan_hari_ini', 'status'];

    public function riwayat_harian(){
        return $this->hasMany(RiwayatHarian::class);
    }
}
