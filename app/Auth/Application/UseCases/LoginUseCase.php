<?php

declare(strict_types=1);

namespace App\Auth\Application\UseCases;

use App\Auth\Application\DTO\LoginDto;
use App\Auth\Domain\Entities\Login;
use App\Auth\Domain\Repositories\IAuthRepository;

final class LoginUseCase
{
    private IAuthRepository $iAuthRepository;

    public function __construct(IAuthRepository $iAuthRepository)
    {
        $this->iAuthRepository = $iAuthRepository;
    }

    public function execute(LoginDto $loginDto): array
    {
        $login = new Login(
            $loginDto->email,
            $loginDto->password,
            $loginDto->ip,
        );
        return $this->iAuthRepository->login($login);
    }
}
