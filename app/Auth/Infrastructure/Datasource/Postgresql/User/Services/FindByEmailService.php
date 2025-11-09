<?php

declare(strict_types=1);

namespace App\Auth\Infrastructure\Datasource\Postgresql\User\Services;

use App\Auth\Domain\Entities\User as DomainUser;
use App\Auth\Domain\ValueObjects\Email;
use App\Auth\Infrastructure\Datasource\Postgresql\User\Mappers\UserMapper;
use App\Auth\Infrastructure\Models\User as EloquentUser;

final class FindByEmailService
{
    protected UserMapper $userMapper;

    public function __construct(
        UserMapper $userMapper,
    ) {
        $this->userMapper = $userMapper;
    }

    public function getUser(Email $email): DomainUser|null
    {
        $eloquentUser = EloquentUser::where('email', $email->value)->first();

        if (!$eloquentUser) {
            return null;
        }

        return $this->userMapper->toDomainEntity($eloquentUser);
    }
}
