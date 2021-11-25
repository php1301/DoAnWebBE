<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViecLam extends Model
{
    use HasFactory;

    protected $table = 'ViecLams';
    protected $filltable = ['id_vl', 'tenViecLam', 'id_cty', 'id_nn'];

    public function CongTys()
    {
        # code...
        return $this->belongsTo(CongTy::class, 'id_cty', 'id');
    }

    public function ThongTinViecLams()
    {
        return $this->hasMany('App\Models\ThongTinViecLam', 'id_vl', 'id');
    }

    public function NganhNghe()
    {
        # code...
        return $this->belongsTo('App\Models\NganhNghe', 'id_nn', 'id_nn');
    }
    public function KhuVuc()
    {
        # code...
        return $this->belongsTo('App\Models\KhuVuc', 'id_kv', 'id_kv');
    }
    public function UngTuyens()
    {
        return $this->hasMany('App\Models\UngTuyen', 'id_vl', 'id');
    }
}
