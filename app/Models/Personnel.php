<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personnel extends Model
{
    use HasFactory;

    /**
     * Spécifie le nom de la table
     *
     * @var string
     */
    protected $table = 'personnel';

    /**
     * Les attributs qui sont assignables en masse.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'poste',
        'departement',
        'salaire_base',
        'date_embauche',
        'statut',
    ];

    /**
     * Les attributs qui doivent être convertis.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_embauche' => 'date',
        'salaire_base' => 'decimal:2',
    ];

    /**
     * Obtenir le nom complet du membre du personnel
     *
     * @return string
     */
    public function getNomCompletAttribute(): string
    {
        return "{$this->prenom} {$this->nom}";
    }

    /**
     * Vérifie si le membre du personnel est actif
     *
     * @return bool
     */
    public function isActif(): bool
    {
        return $this->statut === 'actif';
    }
} 