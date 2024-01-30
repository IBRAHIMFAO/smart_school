<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartementProf extends Model
{
    use HasFactory;
    protected $table = 'departement_prof';
    protected $fillable = ['code_departement', 'code_prof']; // Add 'code_prof' to the fillable array


    public function departement()
    {
        return $this->belongsTo(Departement::class, 'code_departement', 'id');
    }

    public function prof()
    {
        return $this->belongsTo(Prof::class, 'code_prof', 'id');
    }
}
