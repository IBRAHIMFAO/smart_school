<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Seance extends Model
{

    use HasFactory;
    // protected $fillable = ['code_group', 'code_matiere', 'code_prof', 'code_salle', 'date', 'heure_debut', 'heure_fin', 'code_annee_scolaire', 'periodicite'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'heure_debut' => 'datetime',
        'heure_fin' => 'datetime',
    ];

    protected $fillable = [
        'date',
        'heure_debut',
        'heure_fin',
        'annee_scolaire',
        'periodicite',
        'code_salle',
        'code_prof',
        'code_matiere',
        'code_group',
        
    ];


public function salle(){
    return $this->belongsTo(Salle::class,'code_salle');
}
public function prof(){
    return $this->belongsTo(Prof::class,'code_prof');
}
public function matiere(){
    return $this->belongsTo(Matiere::class,'code_matiere');
}
public function group(){
    return $this->belongsTo(Group::class,'code_group');
}



public function attendances()
{
    return $this->hasMany(Attendance::class, 'code_seance', 'id');
}

/**
 * Check if attendance is recorded for this session
 *
 * @return bool
 */

    public function isAttendanceRecorded()
    {
        return $this->attendances()->exists();
    }

    // ... other model code

    public function duree()
    {
        $heureDebut = Carbon::parse($this->heure_debut);
        $heureFin = Carbon::parse($this->heure_fin);

        // Calculate the difference in hours and minutes
        $diff = $heureDebut->diff($heureFin);

        return $diff->format('%hh %im');
    }

  
     /**
     * Get the duration of the seance in minutes.
     *
     * @return int
     */
    public function dureeInMinutes()
    {
        // Assuming heure_debut and heure_fin are Carbon instances
        return $this->heure_debut->diffInMinutes($this->heure_fin);
    }



// ####################################################################################
// public function anneeScolaire()
//     {
//         return $this->belongsTo(AnneeScolaire::class, 'code_annee_scolaire');
//     }

}
