<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Referentiel extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'libelle',
        'description',
        'photo',
        'statut', // Actif, Inactif, Archiver
        'competences', // JSON: Liste des compétences et leurs modules
    ];

    // Cast competences field as an array
    protected $casts = [
        'competences' => 'array',
    ];
}
