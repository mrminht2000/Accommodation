<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    public function house () {
        return $this->belongsTo('App\house','idHouse','idHouse');
    }

    public function owner () {
        return $this->belongsTo('App\account','id','idOwner');
    }
}
