<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'post_id',
        'comments'
    ];
       // relationship of user & post is one to many;
       public function post(){
        return $this->belongsTo(Post::class);
    }
}
