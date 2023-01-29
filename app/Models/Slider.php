<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $table='sliders';
    protected $fillable=['name','photo','description','subdescription','price','link','created_at','updated_at'];
    protected $hidden=['created_at','updated_at'];

    public function scopeSelection($query)
    {
        return $query->select('id', 'name','photo', 'description','subdescription','price','link');
    }

}
