<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;
    protected $fillable = ['code_ecole', 'label', 'description'];

    public function ecole()
    {
        return $this->belongsTo(Ecole::class, 'code_ecole');
    }

    public function filieres()
    {
        return $this->hasMany(Filiere::class, 'code_departement');
    }

    // Relation avec le modèle Prof : Un département peut avoir plusieurs professeurs
    public function profs()
    {
        return $this->belongsToMany(Prof::class, 'departement_prof', 'code_departement', 'code_prof');
    }
}
