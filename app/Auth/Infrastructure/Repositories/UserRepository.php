<?php

declare(strict_types=1);

namespace App\Auth\Infrastructure\Repositories;

use App\Auth\Domain\Entities\User;
use App\Auth\Domain\Repositories\IUserRepository;
use App\Auth\Domain\ValueObjects\Email;
use App\Auth\Domain\ValueObjects\UserId;
use App\Auth\Infrastructure\Datasource\IUserDatasource;

final class UserRepository implements IUserRepository
{
    private IUserDatasource $iUserDatasource;

    public function __construct(IUserDatasource $iUserDatasource)
    {
        $this->iUserDatasource = $iUserDatasource;
    }

    public function nextIdentity(): UserId
    {
        return $this->iUserDatasource->nextIdentity();
    }

    public function findByEmail(Email $email): ?User
    {
        return $this->iUserDatasource->findByEmail($email);
    }

    public function save(User $user): array
    {
        return $this->iUserDatasource->save($user);
    }
}
