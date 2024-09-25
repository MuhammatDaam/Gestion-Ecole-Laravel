<?php
namespace App\Models\Firebase;

use App\Models\Firebase\FirebaseModel;

class PromotionFirebase extends FirebaseModel
{
    // Define properties and methods specific to the Promotion model here.
    protected $table = 'promotions';

    protected $fillable = [
        'libelle',
        'date_debut',
        'date_fin',
        'duree',
        'etat',
        'referentiels',
        'photo',
    ];

    // You can add additional methods as needed.
}
