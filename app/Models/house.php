<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class house extends Model
{
    protected $table = "house";

    public function owner () {
        return $this->belongsTo('App\account','id','idOwner');
    }

    public function review () {
        return $this->hasMany('App\review','idHouse','idHouse');
    }

    public function post () {
        return $this->hasMany('App\post','idHouse','idHouse');
    }

    public function choosedHouse() {
        return $this->belongsTo('App\choosedhouse','idHouse','idHouse');
    }
}
