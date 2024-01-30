<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Matiere extends Model
{
    use HasFactory;
    protected $fillable = ['label', 'description', 'code_filiere'];

    public function niveauxscolaire()
    {
        return $this->belongsTo(Niveauxscolaire::class, 'code_niveauxscolaire');
    }


public function seance (){
    return $this->hasMany(Seance::class,'code_seance');
}
}
