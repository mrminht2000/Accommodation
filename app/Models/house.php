<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class house extends Model
{
    protected $table = "house";

    public function account () {
        return $this->belongsTo('App\Models\account','idOwner','id');
    }

    public function review () {
        return $this->hasMany('App\Models\review','idHouse','idHouse');
    }

    public function post () {
        return $this->hasMany('App\Models\post','idHouse','idHouse');
    }

    public function choosedhouse() {
        return $this->belongsTo('App\Models\choosedhouse','idHouse','idHouse');
    }

    public function housetype() {
        return $this->belongsTo('App\Models\housetype','id_type','id');
    }

    public function provinces () {
        return $this->belongsTo('App\Models\provinces','province_id','id');
    }

    public function districts () {
        return $this->belongsTo('App\Models\districts','id_districts','id');
    }
}
