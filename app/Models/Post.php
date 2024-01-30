<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;    // Add this line

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'content',
        'type',
        'code_user',
        'image_path',
        'code_group',
        'code_matiere'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'code_user');
    }

    // Define relationships with likes and comments
    public function likes()
    {
        return $this->hasMany(Like::class, 'code_post');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'code_post');
    }

    // Add this method
    public function matiere(){
        return $this->belongsTo(Matiere::class, 'code_matiere');
    }

    // public function groups(){
    //     return $this->belongsTo(Group::class, 'code_group');
    // }



        // groups relationship (many-to-many) with the Post model
        public function groups()
        {
            return $this->belongsToMany(Group::class, 'post_group', 'code_post', 'code_group');
        }




        public function isLiked()
    {
        $user = Auth::user();

        if (!$user) {
            return false;
        }

        return $this->likes()->where('code_user', $user->id)->exists();
    }



}
