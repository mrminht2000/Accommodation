<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class review extends Model
{
    protected $table = "review";

    public function house () {
        return $this->belongsTo('App\Models\house','idHouse','idHouse');
    }

    public function account () {
        return $this->belongsTo('App\Models\account','id','idUser');
    }
}
