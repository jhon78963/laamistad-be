<?php

declare(strict_types=1);

namespace App\Auth\Infrastructure\Datasource\Postgresql\User\Services;

use App\Auth\Domain\Entities\Role as DomainRole;
use App\Auth\Domain\ValueObjects\UserId;
use App\Auth\Infrastructure\Models\User as EloquentUser;

final class FindRoleByUserId
{
    public function getRole(UserId $userId): DomainRole|null
    {
        $result = EloquentUser::with('role')->find($userId->value)?->role;

        if (!$result) {
            return null;
        }

        return new DomainRole(
            id: $result->id,
            description: $result->description
        );
    }
}
