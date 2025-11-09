<?php

declare(strict_types=1);

namespace App\Auth\Infrastructure\Datasource;

use App\Auth\Domain\Entities\Login;
use App\Auth\Domain\Entities\Logout;
use App\Auth\Domain\Entities\RefreshToken;

interface IAuthDatasource
{
    public function googleLogin(string $googleToken): array;
    public function login(Login $login): array;
    public function logout(Logout $logout): void;
    public function refreshToken(RefreshToken $refreshToken): array;

}
