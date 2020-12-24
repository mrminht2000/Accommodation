<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class choosedhouse extends Model
{
    protected $table = "choosedhouse";

    public function house () {
        return $this->hasOne('App\Models\house','id','idHouse');
    }

    public function account () {
        return $this->hasOne('App\Models\account','id','idRenter');
    }
}
