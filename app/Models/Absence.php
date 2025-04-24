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


    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
        'justifie' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getDureeAttribute()
    {
        return $this->date_debut->diffInDays($this->date_fin) + 1;
    }
} 