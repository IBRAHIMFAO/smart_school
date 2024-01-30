<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salle extends Model
{
    use HasFactory;
    protected $fillable = [
        'label',
        'description',
        'status', // Ajout du champ 'status' pour salle, atelier, salle informatique
    ];

    public function pavilion()
    {
        return $this->belongsTo(Pavilion::class, 'code_pavilion', 'id');
    }

public function seance(){
    // return $this->hasMany(Seance::class,'code_seance');
    return $this->hasMany(Seance::class,'code_salle');

}

}
