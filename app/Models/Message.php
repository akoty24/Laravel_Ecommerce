<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $table='messages';
    protected $fillable = [ 'fname', 'lname', 'email', 'subject', 'comment','created_at', 'updated_at' ];
    public function scopeSelection($query)
    {
        return $query->select('id','fname', 'lname', 'email', 'subject', 'comment','created_at', 'updated_at' );
    }
}
