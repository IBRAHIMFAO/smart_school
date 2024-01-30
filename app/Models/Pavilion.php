<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pavilion extends Model
{
    use HasFactory;
    protected $fillable = [
        'label',
        'description',
        // Ajoutez ici d'autres champs selon vos besoins
    ];

    public function salles()
    {
        return $this->hasMany(Salle::class, 'code_pavilion', 'id');
    }
}
