<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','product_id','created_at', 'updated_at'];

    public function products(){
        return $this->belongsTo(Product::class,'product_id');
    }
    public function users(){
        return $this->belongsTo(User::class,'user_id');
    }
}
