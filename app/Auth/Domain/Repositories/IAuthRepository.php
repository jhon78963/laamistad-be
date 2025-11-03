<?php

declare(strict_types=1);

namespace App\Auth\Domain\Repositories;

use App\Auth\Domain\Entities\Login;
use App\Auth\Domain\Entities\Logout;
use App\Auth\Domain\Entities\RefreshToken;
use App\Auth\Domain\Entities\Register;

interface IAuthRepository
{
    public function googleLogin(string $googleToken): array;
    public function login(Login $login): array;
    public function logout(Logout $logout): void;
    public function refreshToken(RefreshToken $refreshToken): array;
    public function register(Register $register): array;
}
