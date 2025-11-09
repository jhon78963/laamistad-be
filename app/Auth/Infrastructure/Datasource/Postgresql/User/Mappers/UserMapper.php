<?php

declare(strict_types=1);

namespace App\Auth\Infrastructure\Datasource\Postgresql\User\Mappers;

use App\Auth\Domain\Entities\User as DomainUser;
use App\Auth\Domain\ValueObjects\Email;
use App\Auth\Domain\ValueObjects\HashedPassword;
use App\Auth\Domain\ValueObjects\UserId;
use App\Auth\Infrastructure\Models\User as EloquentUser;

final class UserMapper
{
    public function toDomainEntity(EloquentUser $eloquentUser): DomainUser
    {
        return DomainUser::create(
            id: new UserId($eloquentUser->id),
            name: $eloquentUser->name,
            email: new Email($eloquentUser->email),
            password: new HashedPassword($eloquentUser->password)
        );
    }
}
