<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Services\Interfaces\AuthentificationServiceInterface;

class AuthentificationServicePassport implements AuthentificationServiceInterface
{

    public function authentificate(array $credentials)
    {
        $user = User::where('email', $credentials['email'])->firstOrFail();
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        $token = $user->createToken('auth_token')->accessToken;
        $refreshToken = Str::random(60);
        $user->refresh_token = hash('sha256', $refreshToken);
        $user->save();

        return [
            'token' => $token,
            'refresh_token' => $refreshToken,
            'user' => $user
        ];
    }

    public function logout()
    {
        // TODO: Implement logout() method.
    }
}
