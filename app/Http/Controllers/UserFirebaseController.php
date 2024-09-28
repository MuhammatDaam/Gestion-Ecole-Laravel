<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\UserFirebaseServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UserFirebaseController extends Controller
{
    protected $userService;

    public function __construct(UserFirebaseServiceInterface $userService)
    {
        $this->userService = $userService;

    //      // Protéger les routes par des rôles spécifiques
    // $this->middleware('role:admin')->only(['create', 'updateUser', 'deleteUser']);
    // $this->middleware('role:admin,manager')->only(['getAllUsers', 'getUsersByRole']);
    // $this->middleware('role:user,admin,manager')->only(['findUser', 'findUserByEmail', 'findUserByPhone']);
    }

    // Create a new user
    public function create(Request $request): JsonResponse
    {
        $user = $this->userService->createUser($request->all());

        return response()->json(['user' => $user], 201);
    }

    // Update an existing user
    public function updateUser(string $id, Request $request): JsonResponse
    {
        try {
            $user = $this->userService->updateUser($id, $request->all());

            if (!$user) {
                return response()->json(['message' => 'User not found or update failed'], 404);
            }

            return response()->json(['user' => $user], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while updating the user'], 500);
        }
    }


    // Delete a user
    public function deleteUser(string $id): JsonResponse
    {
        $this->userService->deleteUser($id);

        return response()->json(['message' => 'User deleted successfully'], 200);
    }

    // Find a user by ID
    public function findUser(string $id): JsonResponse
    {
        $user = $this->userService->findUser($id);

        return response()->json(['user' => $user], 200);
    }

    // Get all users
    public function getAllUsers(): JsonResponse
    {
        $users = $this->userService->getAllUsers();

        return response()->json(['users' => $users], 200);
    }

    // Find a user by email
    public function findUserByEmail(Request $request): JsonResponse
    {
        $user = $this->userService->findUserByEmail($request->input('email'));

        return response()->json(['user' => $user], 200);
    }

    // Find a user by phone
    public function findUserByPhone(Request $request): JsonResponse
    {
        $user = $this->userService->findUserByPhone($request->input('telephone'));

        return response()->json(['user' => $user], 200);
    }

    // Obtenir des utilisateurs par rôle
    public function getUsersByRole(Request $request, string $role): JsonResponse
    {
        $users = $this->userService->getUsersByRole($role);
        return response()->json(['users' => $users], 200);
    }

    // Create a user with email and password
    public function createUserWithEmailAndPassword(Request $request): JsonResponse
    {
        $user = $this->userService->createUserWithEmailAndPassword(
            $request->input('email'),
            $request->input('password')
        );

        return response()->json(['user' => $user], 201);
    }

    // Upload an image to storage
    public function uploadImageToStorage(Request $request): JsonResponse
    {
        $url = $this->userService->uploadImageToStorage(
            $request->file('file')->getRealPath(),
            $request->input('file_name')
        );

        return response()->json(['url' => $url], 200);
    }
}
