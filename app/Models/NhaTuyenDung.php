<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhaTuyenDung extends Model
{
    use HasFactory;
    protected $table = 'NhaTuyenDungs';
    protected $filltable = ['id', 'id_user', 'id_cty', 'tenNhaTuyenDung', 'chucVuNhaTuyenDung', 'sdtNhaTuyenDung', 'diachi_ndk'];

    public function User()
    {
        # code...
        return $this->belongsTo('App\Models\User', 'id_user', 'id');
    }
    public function Cti()
    {
        # code...
        return $this->belongsTo('App\Models\CongTy', 'id_cty', 'id');
    }
    public function ungtuyens()
    {
        return $this->hasMany('App\Models\UngTuyen', 'id_ntd', 'id');
    }
}
