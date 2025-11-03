<?php

declare(strict_types=1);

namespace App\Auth\Application\UseCases;

use App\Auth\Application\DTO\LogoutDto;
use App\Auth\Domain\Entities\Logout;
use App\Auth\Domain\Repositories\IAuthRepository;

final class LogoutUseCase
{
    private IAuthRepository $iAuthRepository;

    public function __construct(IAuthRepository $iAuthRepository)
    {
        $this->iAuthRepository = $iAuthRepository;
    }

    public function execute(LogoutDto $logoutDto): void
    {
        $logout = new Logout(
            $logoutDto->accessToken,
            $logoutDto->refreshToken,
        );
        $this->iAuthRepository->logout($logout);
    }
}
