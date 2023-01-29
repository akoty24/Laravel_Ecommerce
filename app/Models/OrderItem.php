<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $table ='order_items';
    protected $fillable=['id','order_id','product_id','quantity','rstatus','price','created_at','updated_at'];
public function status(){
    return $this->rstatus == 0 ? 'delivered' : 'canceled';
}
    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function orders(){
        return $this->belongsTo(Order::class, 'order_id');
    }
    public function reviews(){
        return $this->hasOne(Review::class, 'order_item_id');
    }
}
