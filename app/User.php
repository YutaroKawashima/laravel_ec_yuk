<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function carts(){

        return $this->hasMany('App\Cart');
    }

    public function product(){

        return $this->belongsToMany(
            'App\Product',
            'carts',
            'user_id',
            'product_id',
        );
    }

    public function add_to_cart($product_id){

        if ( $this->carts->where('product_id', $product_id)->isEmpty() ) {

            $cart = new Cart();

            $cart->user_id = $user->id;
            $cart->product_id = $product_id;
            $cart->amount = 1;

        } else {

            $cart = $this->carts->where('product_id', $product_id)->first();
            $cart->amount += 1;
        }

        $cart->save();
    }
}
