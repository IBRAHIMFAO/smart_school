<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnneeScolaire extends Model
{
    use HasFactory;

    protected $table = 'annee_scolaire';

    protected $fillable = ['start_date', 'end_date'];


    public function ecoles()
    {
        return $this->hasMany(Ecole::class, 'code_annee_scolaire');
    }
}
