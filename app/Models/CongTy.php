<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CongTy extends Model
{
    use HasFactory;

    protected $table = 'CongTys';
    protected $filltable = ['logo', 'tenCongTy', 'emailCongTy', 'sdt', 'diaChi'];

    public function NhaTuyenDungs()
    {
        return $this->hasMany('App\Models\NhaTuyenDung', 'id_cty', 'id');
    }
    public function KhuVucs()
    {
        return $this->belongsTo('App\Models\KhuVuc', 'id_kv', 'id_kv');
    }
    public function ViecLams()
    {
        return $this->hasMany(ViecLam::class, 'id_cty', 'id');
    }
    public function users()
    {
        return $this->belongsTo('App\Models\User', 'id', 'id');
    }
    public function ungtuyens()
    {
        return $this->hasMany('App\Models\UngTuyen', 'id_ntd', 'id');
    }
    public function NganhNghes()
    {
        return $this->belongsTo('App\Models\NganhNghe', 'id_nn', 'id_nn');
    }
}
