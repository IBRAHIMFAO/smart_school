<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filiere extends Model
{
    use HasFactory;

    protected $fillable = ['code_departement', 'nom_filiere', 'description'];

    public function departement()
    {
        return $this->belongsTo(Departement::class, 'code_departement');
    }

    public function niveauxscolaires()
    {
        return $this->hasMany(Niveauxscolaire::class, 'code_filiere');
    }

}
