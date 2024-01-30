<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    // protected $fillable = ['name','firstName','lastName' ,'codeRFID','code_group','code_tuteur'];
    protected $fillable = [
        'first_name',
        'last_name',
        'first_name_ar',
        'last_name_ar',
        'birthdate',
        'birthplace',
        'address',
        'cne',
        'codeRFID',
        'cin',
        'monthly_fee',
        'code_user',
        'code_group',
        'code_tuteur',
    ];

    public function attendances()
    {
        return $this->hasMany(Attendance::class,'code_student');
    }



    public function group()
    {
        return $this->belongsTo(Group::class, 'code_group');
    }

    public function tuteur(){
        return $this->belongsTo(Tuteur::class,'code_tuteur');
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'code_user');
    }


}


