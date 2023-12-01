<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auth extends Model
{
    protected $fillable=['email','password'];

    public function blog()
    {
        return $this->hasMany(Blog::class,'user_id');
    }

    use HasFactory;
}
