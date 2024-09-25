<?php

namespace App\Services\Interfaces;

interface FirebaseServiceInterface
{
    public function getDatabase();
    public function getAuth();
    public function getStorage();
}
