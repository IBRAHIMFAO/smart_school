<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = ['nom_group', 'description', 'code_niveauxscolaire'];




    public function niveauxscolaire()
    {
        return $this->belongsTo(Niveauxscolaire::class, 'code_niveauxscolaire');
    }

    public function filiere()
    {
        return $this->belongsTo(Filiere::class, 'code_filiere');
    }

    public function students()
    {
        return $this->hasMany(Student::class,'code_student');
    }


    public function seances()
    {
        return $this->hasOne(Seance::class, 'code_group');
    }

    // Post relationship (many-to-many) with the Group model
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_group', 'code_group', 'code_post');
    }


#########################################################################
// public function absences()
// {
//     return $this->hasManyThrough(Attendance::class, Seance::class, 'code_group', 'code_seance');
// }
#########################################################################

}
