<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function categories(){
        return $this->belongsTo(Category::class,'id');
    }

    public function order_details(){
        return $this->hasMany(Order_Detail::class,'id');
    }

    // public function orders(){
    //     return $this->belongsToMany(Order::class, 'id');
    // }
}
