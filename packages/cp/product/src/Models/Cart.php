<?php

namespace Cp\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Cp\Product\Models\Cart;
use Illuminate\Support\Facades\Session;

class Cart extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
    public static function getCartItems()
    {
        if (Auth::check()) {
            $getCartItems = Cart::with(['product' => function ($query) {
                $query->select('id', 'name_en', 'price', 'discount', 'final_price', 'slug', 'featured_image');
            }])->orderBy('id')->where('user_id', Auth::user()->id)->get();
        } else {
            $getCartItems = Cart::with(['product' => function ($query) {
                $query->select('id', 'name_en', 'price', 'discount', 'final_price', 'slug', 'featured_image');
            }])->orderBy('id')->where('session_id', Session::get('session_id'))->get();
        }
        return $getCartItems;
    }


    function totalCartItems()
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $totalCartItems = Cart::where('user_id', $user_id)->sum('quantity');
        } else {
            $session_id = Session::get('session_id');
            $totalCartItems = Cart::where('session_id', $session_id)->sum('quantity');
        }
        return $totalCartItems;
    }



    function  totalCartAmount()
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $totalCart = Cart::where('user_id', $user_id)->get();
            $total_price = 0;
            foreach ($totalCart as $cart) {
            $total_price = $total_price + ($cart->product->final_price * $cart->quantity);
            }
        } else {
            $session_id = Session::get('session_id');
            $totalCart = Cart::where('session_id', $session_id)->get();
            $total_price = 0;
            foreach ($totalCart as $cart) {
            $total_price = $total_price + ($cart->product->final_price * $cart->quantity);
            }
        }
        return  $total_price;
    }


}