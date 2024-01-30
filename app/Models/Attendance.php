<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

     protected $fillable = ['code_student','status','code_seance','motif_absence','attendance_type' ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'code_student');
    }

    public function seance(){
        return $this->belongsTo(Seance::class,'code_seance');
    }

    // public function group(){
    //     $this->hasOne(Group::class);
    // }


}

