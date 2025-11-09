<?php

declare(strict_types=1);

namespace App\Auth\Infrastructure\Datasource\Postgresql\Auth\Services;

use App\Auth\Infrastructure\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

final class RefreshTokenService
{
    public function getPayloadFromRefreshToken(string $refreshToken): mixed
    {
        $payload = JWTAuth::setToken($refreshToken)->getPayload();
        if (!$payload->get('refresh')) {
            return ['error' => 'Invalid refresh token'];
        }

        return $payload;
    }

    public function getUserFromRefreshToken($payload): User|array
    {
        $userId = $payload->get('sub');
        $user = User::find($userId);
        if (!$user) {
            return ['error' => 'User not found'];
        }

        return $user;
    }

    public function validateRefreshToken(string $refreshToken)
    {
        if (!$refreshToken) {
            return ['error' => 'Refresh token is required'];
        }
    }

    public function invalidateToken(?string $token): void
    {
        if (!$token) {
            return;
        }

        try {
            JWTAuth::setToken($token)->invalidate();
        } catch (\Exception $e) {
            logger()->warning('Token invalidate failed', ['token' => $token, 'error' => $e->getMessage()]);
        }
    }
}
