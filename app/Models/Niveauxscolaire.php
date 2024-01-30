<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Niveauxscolaire extends Model
{
    use HasFactory;

        protected $fillable = ['code_filiere', 'label'];

        public function filiere()
        {
            return $this->belongsTo(Filiere::class, 'code_filiere');
        }


        public function groups()
        {
            return $this->hasMany(Group::class, 'code_niveauxscolaire');
        }


        public function matiere ()
        {
            return $this->hasMany(Matiere::class,'code_matiere');
        }


}
