<?php

declare(strict_types=1);

namespace App\Auth\Domain\Repositories;

use App\Auth\Domain\Entities\Role;
use App\Auth\Domain\Entities\User;
use App\Auth\Domain\ValueObjects\Email;
use App\Auth\Domain\ValueObjects\UserId;

interface IUserRepository
{
    public function nextIdentity(): UserId;
    public function findByEmail(Email $email): ?User;
    public function save(User $user): array;
    public function findRoleByUserId(UserId $userId): ?Role;
}
