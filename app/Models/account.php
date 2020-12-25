<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class account extends Model
{
    protected $table = "account";

    public function house () {
        return $this->hasMany('App\Models\house','idOwner','id');
    }

    public function post () {
        return $this->hasMany('App\Models\post','idOwner','id');
    }

    public function choosedhouse () {
        return $this->hasOne('App\Models\choosedhouse','idRenter','id');
    }

    public function review () {
        return $this->hasMany('App\Models\review','idUser','id');
    }

    public function report () {
        return $this->hasMany('App\Models\report','idUser','id');
    }
}
