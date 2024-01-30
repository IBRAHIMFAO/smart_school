<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caissier extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'first_name_ar',
        'last_name_ar',
        'NIF',
        'birthdate',
        'cin',
        'salary',
        'code_user',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'code_user');
    }
}
