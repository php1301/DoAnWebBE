<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NganhNghe extends Model
{
    use HasFactory;

    protected $table = 'NganhNghes';
    protected $filltable = ['tenNganhNghe'];

    public function ViecLams()
    {
        return $this->hasMany('App\Models\ViecLam', 'id_nn', 'id_nn');
    }
    public function CongTys()
    {
        return $this->hasMany('App\Models\CongTy', 'id_nn', 'id_nn');
    }
}
