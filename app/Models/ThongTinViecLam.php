<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThongTinViecLam extends Model
{
    use HasFactory;

    protected $table = 'thongtinvieclams';
    protected $filltable = ['id', 'ngayHetHan', 'mucLuong', 'tinhChat', 'moTa', 'yeuCau', 'soLuong', 'diaChi', 'bangCap', 'kinhNghiem', 'chuyenMon', 'viTri', 'chucVu', 'gioiTinh', 'tuoi'];

    public function ViecLam()
    {
        # code...
        return $this->belongsTo('App\Models\ViecLam', 'id_vl', 'id');
    }
}
