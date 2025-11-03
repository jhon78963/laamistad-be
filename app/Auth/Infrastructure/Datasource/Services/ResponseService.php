<?php

declare(strict_types=1);

namespace App\Auth\Infrastructure\Datasource\Services;

use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;

final class ResponseService
{
    public function generateTokens($user, bool $sendRefreshToken = true): array
    {
        $accessToken = JWTAuth::fromUser($user);
        $accessTtlMinutes = JWTAuth::factory()->getTTL();
        $accessTtlSeconds = $accessTtlMinutes * 60;

        if (!$sendRefreshToken) {
            return [
                'accessToken' => $accessToken,
                'expirationToken' => $accessTtlSeconds,
            ];
        }

        $refreshTtlMinutes = 60 * 24 * 7;
        $refreshTtlSeconds = $refreshTtlMinutes * 60;

        $payload = JWTFactory::customClaims([
            'sub' => $user->id,
            'refresh' => true,
        ])->setTTL($refreshTtlMinutes)->make();

        $refreshToken = JWTAuth::encode($payload)->get();

        return [
            'accessToken' => $accessToken,
            'refreshToken' => $refreshToken,
            'expirationToken' => $accessTtlSeconds,
            'expirationRefreshToken' => $refreshTtlSeconds,
        ];
    }

    public function generateAccessTokenResponse($user): array
    {
        $auth = $this->generateTokens($user);

        return [
            'accessToken' => $auth['accessToken'],
            'refreshToken' => $auth['refreshToken'],
            'expirationToken' => $auth['expirationToken'],
            'expirationRefreshToken' => $auth['expirationRefreshToken'],
        ];
    }

    public function generateRefreshTokenResponse($user, $accessToken, $refreshToken): array
    {
        $auth = $this->generateTokens($user, false);

        if ($accessToken) {
            JWTAuth::setToken($accessToken)->invalidate();
        }

        JWTAuth::setToken($refreshToken)->invalidate();

        return [
            'accessToken' => $auth['accessToken'],
            'expirationToken' => $auth['expirationToken'],
        ];
    }
}
