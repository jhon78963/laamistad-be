<?php

declare(strict_types=1);

namespace App\Auth\Application\UseCases;

use App\Auth\Domain\Repositories\IUserRepository;
use App\Auth\Domain\ValueObjects\UserId;
use App\Auth\Domain\Entities\Role;

final class GetUserRoleUseCase
{
    public function __construct(
        private readonly IUserRepository $iUserRepository,
    ) {}

    public function execute(UserId $userId): ?Role
    {
        return $this->iUserRepository->findRoleByUserId($userId);
    }
}
