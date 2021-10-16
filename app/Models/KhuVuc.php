<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhuVuc extends Model
{
    use HasFactory;

    protected $table = 'KhuVucs';
    protected $filltable = ['tenKhuVuc'];

    public function CongTys()
    {
        # code...
        return $this->hasMany('App\Models\CongTy', 'id_kv', 'id_kv');
    }
    public function ViecLams()
    {
        return $this->hasMany('App\Models\ViecLam', 'id_kv', 'id_kv');
    }
}
