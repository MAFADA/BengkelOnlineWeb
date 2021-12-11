<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

   public function users(){
       return $this->belongsTo(User::class, 'id');
   }

   public function order_details(){
       return $this->hasMany(Order_Detail::class,'id');
   }
   

//    public function products(){
//        return $this->belongsToMany(Product::class, 'id');
//    }
}
