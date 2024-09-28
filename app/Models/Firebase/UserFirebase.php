<?php

namespace App\Models\Firebase;


class UserFirebase extends FirebaseModel
{
    protected $fillable = [

        'prenom',
        'nom',
        'telephone',
        'email',
        'adresse',
        'photo',
        'fonction',
        'statut',   
        'password',
        'role_id',
    ];

    protected $hidden = [
        'password',
    ];
    
}
