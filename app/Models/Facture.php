<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;

    protected $fillable = [
        'code_payment',
        'numero_facture',
        'date_facture',
        'montant_total',
        'devise',
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'code_payment');
    }
}
