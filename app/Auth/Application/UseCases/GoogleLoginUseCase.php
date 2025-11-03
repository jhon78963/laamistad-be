<?php

declare(strict_types=1);

namespace App\Auth\Application\UseCases;

use App\Auth\Domain\Repositories\IAuthRepository;


final class GoogleLoginUseCase
{
    private IAuthRepository $iAuthRepository;

    public function __construct(IAuthRepository $iAuthRepository)
    {
        $this->iAuthRepository = $iAuthRepository;
    }

    public function execute(string $googleToken): array
    {
        return $this->iAuthRepository->googleLogin($googleToken);
    }
}
