<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tuteur extends Model
{
    use HasFactory;
    protected $fillable = ['firstName','lastName' ,'type','numero_tel','email'];

    public function student (){
        return $this->hasMany(Student::class,'code_tuteur');
    }

    
}


