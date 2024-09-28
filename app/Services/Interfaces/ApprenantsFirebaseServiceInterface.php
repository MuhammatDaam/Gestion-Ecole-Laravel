<?php

namespace App\Services\Interfaces;

interface ApprenantsFirebaseServiceInterface
{
    public function createApprenant(array $data);
    public function findApprenantsById($id);
    public function findApprenantsInactif();
    public function updateApprenants(string $id, array $data);
    public function deleteApprenants(string $id);
    public function findApprenants(string $id);
    public function findApprenantBy_ID(string $id, array $filters);
    public function filterApprenants(array $filters);
    public function getAllApprenants();
    public function findApprenantsByEmail(string $email);
    public function findUserByPhone(string $telephone);
    public function createUserWithEmailAndPassword($email, $password);
    public function uploadImageToStorage($filePath, $fileName);
}
