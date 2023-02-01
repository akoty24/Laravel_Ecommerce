<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = "products";
    protected $fillable = [
        'name','photo', 'active','longdescription','description','price','quantity','category_id', 'created_at', 'updated_at'
    ];


    public function getActive()
    {
        return $this->active == 1 ? 'Active' : 'InActive';
    }
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
  public function scopeSelection($query)
    {
        return $query->select('id', 'name', 'photo', 'active','description','longdescription','quantity','category_id','price');
    }
    public function category(){
        return $this->belongsTo('App\Models\Category','category_id');
    }
    public function orderItems(){
        return $this->hasMany(OrderItem::class,'product_id');
    }
    public function reviews(){
        return $this->hasMany(Review::class,'product_id');
    }
}
