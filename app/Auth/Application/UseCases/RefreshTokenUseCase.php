<?php

declare(strict_types=1);

namespace App\Auth\Application\UseCases;

use App\Auth\Application\DTO\RefreshTokenDto;
use App\Auth\Domain\Entities\RefreshToken;
use App\Auth\Domain\Repositories\IAuthRepository;

final class RefreshTokenUseCase
{
    private IAuthRepository $iAuthRepository;

    public function __construct(IAuthRepository $iAuthRepository)
    {
        $this->iAuthRepository = $iAuthRepository;
    }

    public function execute(RefreshTokenDto $refreshTokenDto): array
    {
        $refreshToken = new RefreshToken(
            $refreshTokenDto->accessToken,
            $refreshTokenDto->refreshToken,
        );
        return $this->iAuthRepository->refreshToken($refreshToken);
    }
}
