<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Services\Interfaces\AuthentificationServiceInterface;

class AuthentificationServiceSanctum implements AuthentificationServiceInterface
{

    public function authentificate(array $credentials)
    {
        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $user = User::where('email', $credentials['email'])->firstOrFail();
        $token = $user->createToken('personnal-access-token')->plainTextToken;
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
        //
    }
}
