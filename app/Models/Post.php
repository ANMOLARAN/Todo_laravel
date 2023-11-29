<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable=['user_id','title','description','image','description'];
    
    public function auth(){
       return $this->belongsTo(Auth::class,'user_id');
    }

    use HasFactory;
}
