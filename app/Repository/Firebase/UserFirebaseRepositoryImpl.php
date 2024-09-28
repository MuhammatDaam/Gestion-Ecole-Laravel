<?php

namespace App\Repository\Firebase;

use App\Repository\Interface\UserFirebaseRepositoryInterface;
use App\Facades\UserFirebaseFacade; // Assurez-vous d'importer la façade correcte

class UserFirebaseRepositoryImpl implements UserFirebaseRepositoryInterface
{
    protected $firebasePath = 'users'; // Définir le chemin Firebase pour les utilisateurs

    public function create(array $data)
    {
        return UserFirebaseFacade::create($this->firebasePath, $data);
    }

    public function update(string $id, array $data)
    {
        return UserFirebaseFacade::update($this->firebasePath, $id, $data);
    }

    public function delete(string $id)
    {
        return UserFirebaseFacade::delete($this->firebasePath, $id);
    }

    public function find(string $id)
    {
        return UserFirebaseFacade::find($this->firebasePath, $id);
    }

    public function getAll()
    {
        return UserFirebaseFacade::getAll($this->firebasePath);
    }

    public function findUserByEmail(string $email)
    {
        return UserFirebaseFacade::findUserByEmail($email);
    }

    public function findUserByPhone(string $telephone)
    {
        return UserFirebaseFacade::findUserByPhone($telephone);
    }

    public function createUserWithEmailAndPassword($email, $password)
    {
        return UserFirebaseFacade::createUserWithEmailAndPassword($email, $password);
    }

    public function getUsersByRole(string $role)
    {
        // Récupérer tous les utilisateurs
        $users = $this->getAll();

        // Filtrer les utilisateurs par rôle
        return array_values(array_filter($users, function ($user) use ($role) {
            return isset($user['role_id']) && $user['role_id'] === $role; // Ajuste 'role_id' si nécessaire
        }));
    }

    public function uploadImageToStorage($filePath, $fileName)
    {
        return UserFirebaseFacade::uploadImageToStorage($filePath, $fileName);
    }
}
