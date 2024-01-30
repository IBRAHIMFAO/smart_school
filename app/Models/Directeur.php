<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Directeur extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'code_user'];



    public function user()
    {
        return $this->belongsTo(User::class, 'code_user');
    }

    // Directeur.php
     public function ecole()
      {
        return $this->hasMany(Ecole::class);
    }
}
