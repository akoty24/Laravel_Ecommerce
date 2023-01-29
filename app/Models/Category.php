<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    use HasFactory;
protected $table = "categories";
    protected $fillable = [
         'name', 'slug', 'photo', 'active', 'created_at', 'updated_at'
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
        return $query->select('id', 'name', 'slug', 'photo', 'active');
    }
    public function product(){
        return $this->hasMany(Product::class,'category_id');
    }

}
