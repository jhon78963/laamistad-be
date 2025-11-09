<?php

declare(strict_types=1);

namespace App\Auth\Infrastructure\Datasource\Postgresql\Auth\Services;

use App\Auth\Domain\Entities\Logout;
use Tymon\JWTAuth\Facades\JWTAuth;

final class LogoutService
{
    public function logout(Logout $logout): void
    {
        JWTAuth::setToken($logout->accessToken)->invalidate();
        JWTAuth::setToken($logout->refreshToken)->invalidate();
    }
}
