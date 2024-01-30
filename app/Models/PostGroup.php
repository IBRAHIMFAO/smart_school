<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostGroup extends Model
{
    use HasFactory;
    protected $table = 'post_group';
    protected $fillable = ['code_post', 'code_group']; // Add 'code_prof' to the fillable array

    public function posts()
    {
        return $this->belongsTo(Post::class, 'code_post', 'id');
    }
    public function groups()
    {
        return $this->belongsTo(Group::class, 'code_group', 'id');
    }
}
