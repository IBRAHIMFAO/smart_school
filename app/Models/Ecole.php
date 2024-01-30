<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ecole extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_ecole',
        'adresse',
        'logo',
        'phone',
        'email',
        'lien_facebook',
        'lien_instagram',
        'map_iframe',
        'code_directeur',
        'code_annee_scolaire',
    ];

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

        // Ecole.php
        public function directeur() {
            return $this->belongsTo(Directeur::class ,'code_directeur');
        }


        public function anneeScolaire()
    {
        return $this->belongsTo(AnneeScolaire::class, 'code_annee_scolaire');
    }

}
