<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'user_id',
        'posts',
        'comments'
    ];
       // relationship of user & post is one to many;
       public function user(){
        return $this->belongsTo(user::class);
    }
}
