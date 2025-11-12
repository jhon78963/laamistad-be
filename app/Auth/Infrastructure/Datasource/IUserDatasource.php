<?php

declare(strict_types=1);

namespace App\Auth\Infrastructure\Datasource;

use App\Auth\Domain\Entities\Role;
use App\Auth\Domain\Entities\User;
use App\Auth\Domain\ValueObjects\Email;
use App\Auth\Domain\ValueObjects\UserId;

interface IUserDatasource
{
    public function nextIdentity(): UserId;
    public function findByEmail(Email $email): ?User;
    public function save(User $user): array;
    public function findRoleByUserId(UserId $userId): ?Role;
}
