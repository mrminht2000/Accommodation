<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class provinces extends Model
{
    protected $table = 'provinces';
    public function house(){
    	return $this->hasMany('App\Models\house','district_id','id');
    }

    public function districts() {
        return $this->hasMany('App\Models\districts','province_id','id');
    }
}
