<?php

declare(strict_types=1);

namespace App\Auth\Application\UseCases;

use App\Auth\Application\Contracts\PasswordHasher;
use App\Auth\Application\DTO\RegisterDto;
use App\Auth\Domain\Entities\Register;
use App\Auth\Domain\Entities\User;
use App\Auth\Domain\Exceptions\UserAlreadyExistsException;
use App\Auth\Domain\Repositories\IUserRepository;
use App\Auth\Domain\ValueObjects\Email;
use App\Auth\Domain\ValueObjects\HashedPassword;

final class RegisterUseCase
{
    private IUserRepository $iUserRepository;
    private readonly PasswordHasher $passwordHasher;

    public function __construct(
        IUserRepository $iUserRepository,
        PasswordHasher $passwordHasher
    ) {
        $this->iUserRepository = $iUserRepository;
        $this->passwordHasher = $passwordHasher;
    }

    public function execute(RegisterDto $data): array
    {
        $email = new Email($data->email);
        if ($this->iUserRepository->findByEmail($email)) {
            throw new UserAlreadyExistsException();
        }

        $hashedPassword = new HashedPassword(
            $this->passwordHasher->hash($data->password)
        );

        $user = User::create(
            $this->iUserRepository->nextIdentity(),
            $data->name,
            $email,
            $hashedPassword
        );

        return $this->iUserRepository->save($user);
    }
}
