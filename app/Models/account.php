<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class account extends Model
{
    public function house () {
        return $this->hasMany('App\house','idOwner','id');
    }

    public function post () {
        return $this->hasMany('App\post','idOwner','id');
    }

    public function choosedHouse () {
        return $this->hasOne('App\choosedhouse','idRenter','id');
    }

    public function post () {
        return $this->hasMany('App\post','idOwner','id');
    }

    public function review () {
        return $this->hasMany('App\review','idUser','id');
    }
}
