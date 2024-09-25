<?php

namespace App\Services;

use App\Repository\Interface\UserFirebaseRepositoryInterface;
use App\Services\Interfaces\UserFirebaseServiceInterface;
use Illuminate\Support\Facades\Validator;

class UserFirebaseService implements UserFirebaseServiceInterface
{
    protected $userRepository;

    public function __construct(UserFirebaseRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    // Create a new user
    public function createUser(array $data)
    {
        $validated = $this->validateUserData($data, 'create');
        $validated['password'] = bcrypt($validated['password']);
        return $this->userRepository->create($validated);
    }

    // Update an existing user
public function updateUser(string $id, array $data)
{
    $validated = $this->validateUserData($data, 'update', $id);

    // Hash the password only if it's set in the request
    if (isset($validated['password'])) {
        $validated['password'] = bcrypt($validated['password']);
    }

    // Update the user in the repository
    $updatedUser = $this->userRepository->update($id, $validated);

    if (!$updatedUser) {
        throw new \Exception('User not found or update failed');
    }

    return $updatedUser;
}


    // Delete a user
    public function deleteUser(string $id)
    {
        return $this->userRepository->delete($id);
    }

    // Find a user by ID
    public function findUser(string $id)
    {
        return $this->userRepository->find($id);
    }

    // Get all users
    public function getAllUsers()
    {
        return $this->userRepository->getAll();
    }

    // Find a user by email
    public function findUserByEmail(string $email)
    {
        $this->validate(['email' => $email], ['email' => 'required|email']);
        return $this->userRepository->findUserByEmail($email);
    }

    // Find a user by phone
    public function findUserByPhone(string $telephone)
    {
        $this->validate(['telephone' => $telephone], ['telephone' => 'required|string']);
        return $this->userRepository->findUserByPhone($telephone);
    }

    // Create a user with email and password
    public function createUserWithEmailAndPassword($email, $password)
    {
        $this->validate(
            ['email' => $email, 'password' => $password],
            ['email' => 'required|email|unique:users', 'password' => 'required|min:6']
        );
        return $this->userRepository->createUserWithEmailAndPassword($email, $password);
    }

    public function getUsersByRole($role)
    {
        return $this->userRepository->getUsersByRole($role);
    }

    // Upload an image to storage
    public function uploadImageToStorage($filePath, $fileName)
    {
        $this->validate(
            ['file' => $filePath, 'file_name' => $fileName],
            ['file' => 'required|string', 'file_name' => 'required|string']
        );
        return $this->userRepository->uploadImageToStorage($filePath, $fileName);
    }

    // Validate user data with customizable rules
    private function validateUserData(array $data, string $action, string $id = null)
    {
        $rules = [
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'telephone' => [
                'required',
                'string',
                'unique:users,telephone' . ($id ? ',' . $id : ''),
                'regex:/^\+221(70|75|76|77|78)\d{7}$/'
            ],
            'adresse' => 'nullable|string|max:255',
            'photo' => 'nullable|string',
            'statut' => 'required|in:Actif,Bloquer',
            'role_id' => 'required|exists:roles,id',
            'email' => 'required|email|unique:users,email' . ($id ? ',' . $id : ''),
            'password' => 'required|string|min:6'
        ];

        if ($action === 'update') {
            $rules = array_map(function ($rule) {
                return str_replace('required', 'sometimes', $rule);
            }, $rules);
        }

        return $this->validate($data, $rules);
    }

    // Generic validation function
    private function validate(array $data, array $rules)
    {
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            throw new \Illuminate\Validation\ValidationException($validator);
        }
        return $validator->validated();
    }
}
