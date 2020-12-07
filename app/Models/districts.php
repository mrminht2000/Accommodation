<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class districts extends Model
{
    protected $table = 'districts';
    public function house(){
    	return $this->hasMany('App\Models\house','district_id','id');
    }

    public function provinces () {
        return $this->belongsTo('App\Models\provinces','province_id','id');
    }
}
