<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conge extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date_debut',
        'date_fin',
        'type',
        'motif',
        'statut',
        'commentaire_rh'
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getDureeAttribute()
    {
        return $this->date_debut->diffInDays($this->date_fin) + 1;
    }

    public function getStatutLibelleAttribute()
    {
        return match($this->statut) {
            'en_attente' => 'En attente',
            'accepte' => 'Accepté',
            'refuse' => 'Refusé',
            default => $this->statut
        };
    }

    public function getTypeLibelleAttribute()
    {
        return match($this->type) {
            'annuel' => 'Congé annuel',
            'exceptionnel' => 'Congé exceptionnel',
            'sans_solde' => 'Congé sans solde',
            'maladie' => 'Congé maladie',
            'maternite' => 'Congé maternité',
            'paternite' => 'Congé paternité',
            default => $this->type
        };
    }
} 