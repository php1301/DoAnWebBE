<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UngTuyen extends Model
{
    use HasFactory;
    protected $table = 'UngTuyens';
    public function User()
    {
    	# code...
    	return $this->belongsTo('App\Models\User','id_user','id');
    }
    public function Vieclam()
    {
    	# code...
    	return $this->belongsTo('App\Models\ViecLam','id_vl','id');
    }
    public function Cti()
    {
    	# code...
    	return $this->belongsTo('App\Models\CongTy','id_ntd','id');
    }
}
