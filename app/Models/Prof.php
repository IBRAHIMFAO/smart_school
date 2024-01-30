<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Prof extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'first_name_ar',
        'last_name_ar',
        'hours_worked',
        'birthdate',
        'cin',
        'Doti',
        'family_status',
        'address',
        'code_user',
        // Ajoutez ici d'autres champs selon vos besoins
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'code_user', 'id');
    }

    // Relation avec la table Departement : Un professeur peut appartenir à plusieurs départements
        public function departements()
        {
            return $this->belongsToMany(Departement::class, 'departement_prof', 'code_prof', 'code_departement');
        }


        public function seances(){
            return $this->hasMany(Seance::class,'code_prof');
        }




}
