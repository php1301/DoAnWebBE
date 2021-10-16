<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Luu extends Model
{
    use HasFactory;
    protected $table = 'Luus';

    public function User()
    {
    	# code...
    	return $this->belongsTo('App\Models\User','id_user','id');
    }
    public function ViecLam()
    {
    	# code...
    	return $this->belongsTo('App\Models\VieLam','id_vl','id');
    }
}
