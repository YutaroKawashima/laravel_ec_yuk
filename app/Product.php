<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function stock(){

        return $this->hasOne('App\Stock');
    }

    public function cart(){

        return $this->hasMany('App\Cart');
    }
}
