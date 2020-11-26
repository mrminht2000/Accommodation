<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class choosedhouse extends Model
{
    public function house () {
        return $this->hasMany('App\house','idHouse','idHouse');
    }

    public function renter () {
        return $this->hasOne('App\account','id','idRenter');
    }
}
