<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable ;
protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'lname',
        'email',
        'password',
        'phone',
        'address',
        'address2',
        'city',
        'country',
        'pincode',
        'photo',
        'role',
        'active'
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function getJWTIdentifier() {
        return $this->getKey();
    }
    public function getJWTCustomClaims() {
        return [];
    }

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
        return $query->select('id', 'name','lname','address','address2', 'city','country','pincode','photo', 'email','password', 'phone','role','active');
    }
    public function profile(){
        return $this->hasOne(Profile::class,'user_id');
}
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function cart(){
        return $this->hasMany(Cart::class,'user_id');
    }
    public function wishlist()
    {
        return $this->belongsToMany(Product::class, 'wish_lists')->withTimestamps();
    }
    public function wishlistHas($productId)
    {
        return self::wishlist()->where('product_id', $productId)->exists();
    }
}
