<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'payment_type',
        'status',
        'amount',
        'remaining_amount',
        'payment_date',
        'payment_description',
        'currency',
        'payment_month',
        'payment_year',
        'payment_approval_status',
        'code_student',
        'code_caissier',
        'code_ecole',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'code_student');
    }

    public function caissier()
    {
        return $this->belongsTo(Caissier::class, 'code_caissier');
    }

    public function ecole()
    {
        return $this->belongsTo(Ecole::class, 'code_ecole');
    }

}
