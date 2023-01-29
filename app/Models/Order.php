<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table ='orders';
    protected $fillable=['user_id','total_price','fname','lname','email','phone','address','address2','city','country','pincode','payment_mode','payment_id','status','created_at','updated_at'];

    public function status()
    {
        return $this->status == 0 ?  'canceled':'delivered' ;
    }
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

}
