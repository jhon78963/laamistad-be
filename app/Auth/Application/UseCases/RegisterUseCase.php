<?php

declare(strict_types=1);

namespace App\Auth\Application\UseCases;

use App\Auth\Application\DTO\RegisterDto;
use App\Auth\Domain\Entities\Register;
use App\Auth\Domain\Repositories\IAuthRepository;

final class RegisterUseCase
{
    private IAuthRepository $iAuthRepository;

    public function __construct(IAuthRepository $iAuthRepository)
    {
        $this->iAuthRepository = $iAuthRepository;
    }

    public function execute(RegisterDto $registerDto): array
    {
        $user = new Register(
            $registerDto->firstName,
            $registerDto->otherNames,
            $registerDto->fatherSurname,
            $registerDto->motherSurname,
            $registerDto->cellphoneCodeId,
            $registerDto->cellphoneNumber,
            $registerDto->documentTypeId,
            $registerDto->documentNumber,
            $registerDto->email,
            $registerDto->password,
            $registerDto->headquarterId,
            $registerDto->userTypeId,
        );
        return $this->iAuthRepository->register($user);
    }
}
