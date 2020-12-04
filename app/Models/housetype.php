<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class housetype extends Model
{
    protected $table = "housetype";
    
    public function product() {
        return $this->hasMany('App\Models\house','type','id');
    }
}
