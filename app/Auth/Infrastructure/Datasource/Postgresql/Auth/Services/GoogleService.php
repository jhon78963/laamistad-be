<?php

declare(strict_types=1);

namespace App\Auth\Infrastructure\Datasource\Postgresql\Auth\Services;

use App\Auth\Infrastructure\Models\User;
use Google_Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

final class GoogleService
{
    public function getGooglePayload(string $googleToken): array
    {
        $client = new Google_Client(['client_id' => config('app.googleClientId')]);
        $payload = $client->verifyIdToken($googleToken);
        if (!$payload) {
            return ['error' => 'Token de Google inválido'];
        }

        return $payload;
    }

    public function getGoogleUser(array $payload): User
    {
        $googleId = $payload['sub'];
        $email = $payload['email'];
        $name = $payload['name'];

        return User::updateOrCreate(
            ['email' => $email],
            [
                'google_id' => $googleId,
                'name' => $name,
                'password' => Hash::make(Str::random(24)),
            ],
        );
    }
}
