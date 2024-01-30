<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'code_user',
        'code_post',
    ];

    // Define a relationship with the user who made the comment
    public function user()
    {
        return $this->belongsTo(User::class, 'code_user');
    }

    // Define a relationship with the post that was commented on
    public function post()
    {
        return $this->belongsTo(Post::class, 'code_post');
    }

}
