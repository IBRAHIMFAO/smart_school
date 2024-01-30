<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'code_user',
        'code_group',
    ];

    // Define a relationship with the user
    public function user()
    {
        return $this->belongsTo(User::class, 'code_user');
    }

    // Define a relationship with the group
    public function group()
    {
        return $this->belongsTo(Group::class, 'code_group');
    }
}
