<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date_debut',
        'date_fin',
        'motif',
        'description',
        'justificatif',
        'justifie',
        'commentaire_rh'
    ];


} 