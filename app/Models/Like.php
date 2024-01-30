<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'code_user',
        'code_post',
        'is_like',
    ];

    // Define a relationship with the user who made the like
    public function user()
    {
        return $this->belongsTo(User::class, 'code_user');
    }

    // Define a relationship with the post that was liked
    public function post()
    {
        return $this->belongsTo(Post::class, 'code_post');
    }


    
}
