<?php

namespace App\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Exception\FirebaseException;

class FirebaseService
{
    protected $firebase;
    protected $database;
    public function __construct()
{
    $credentials = '/home/dame/Documents/framework/Laravel/Gestion_Ecole_Laravel/gestion-ecole-laravel-firebase.json';
    // dd($credentials);
    if (is_null($credentials)) {
        throw new \Exception('La variable d\'environnement FIREBASE_CREDENTIALS est nulle.');
    }
    
    $this->firebase = (new Factory)
        ->withServiceAccount($credentials)
        ->withDatabaseUri('https://gestion-ecole-laravel-default-rtdb.firebaseio.com/');  // Charger l'URL de la base de données
    $this->database = $this->firebase->createDatabase();
}


    public function getDatabase()
    {
        return $this->database;
    }

    public function getAuth()
    {
        return $this->database;
    }

    public function getStorage()
    {
        return $this->database;
    }
}
