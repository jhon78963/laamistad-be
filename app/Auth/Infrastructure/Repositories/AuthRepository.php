<?php

declare(strict_types=1);

namespace App\Auth\Infrastructure\Repositories;

use App\Auth\Domain\Entities\Login;
use App\Auth\Domain\Entities\Logout;
use App\Auth\Domain\Entities\RefreshToken;
use App\Auth\Domain\Entities\Register;
use App\Auth\Domain\Repositories\IAuthRepository;
use App\Auth\Infrastructure\Datasource\IAuthDatasource;

final class AuthRepository implements IAuthRepository
{
    private IAuthDatasource $iAuthDatasource;

    public function __construct(IAuthDatasource $iAuthDatasource)
    {
        $this->iAuthDatasource = $iAuthDatasource;
    }

    public function login(Login $login): array
    {
        return $this->iAuthDatasource->login($login);
    }

    public function logout(Logout $logout): void
    {
        $this->iAuthDatasource->logout($logout);
    }

    public function googleLogin(string $googleToken): array
    {
        return $this->iAuthDatasource->googleLogin($googleToken);
    }

        public function refreshToken(RefreshToken $refreshToken): array
    {
        return $this->iAuthDatasource->refreshToken($refreshToken);
    }

    public function register(Register $register): array
    {
        return $this->iAuthDatasource->register($register);
    }
}
