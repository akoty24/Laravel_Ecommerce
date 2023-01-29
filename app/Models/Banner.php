<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $table='banners';
    protected $fillable=['id','title1','photo1','description1','title2','photo2','description2','created_at','updated_at'];
    protected $hidden=['created_at','updated_at'];

    public function scopeSelection($query)
    {
        return $query->select('id','title1','photo1','description1','title2','photo2','description2');
    }

}
