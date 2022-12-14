<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    function category(){
        return $this->belongsTo(Category::class);
    }
    function cart(){
        return $this->hasMany(Cart::class);
    }
    function order(){
        return $this->hasMany(Order::class);
    }
}
