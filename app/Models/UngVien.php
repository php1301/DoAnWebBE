<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UngVien extends Model
{
    use HasFactory;
    protected $table='UngViens';
    protected $filltable=['id','id_user','hinhAnh','gioiTinh','ngaySinh','sdt','diaChi'];

    public function User()
    {
    	return $this->belongsTo('App\Models\User','id_user','id');
    }
}
