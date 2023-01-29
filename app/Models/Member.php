<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $table='members';
    protected $fillable = [ 'name', 'title', 'description', 'photo', 'btn_text','created_at', 'updated_at' ];
    public function scopeSelection($query)
    {
        return $query->select('id', 'name','title', 'description','photo','btn_text');
    }
}
