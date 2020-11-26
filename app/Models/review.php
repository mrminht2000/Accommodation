<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class review extends Model
{
    public function house () {
        return $this->belongsTo('App\house','idHouse','idHouse');
    }

    public function user () {
        return $this->belongsTo('App\account','id','idUser');
    }
}
