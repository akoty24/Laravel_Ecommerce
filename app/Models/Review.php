<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $table='reviews';
    protected $fillable=['rating','product_id','user_id','status','comment','order_item_id','created_at','updated_at'];
    public function users(){
        return $this->belongsTo(User::class,'user_id');
    }
   public function products(){
        return $this->belongsTo(Product::class,'product_id');
    }
 public function orderItem(){
     return $this->belongsTo(OrderItem::class,'order_item_id');
 }
}

