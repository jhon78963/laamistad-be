<?php

declare(strict_types=1);

namespace App\Auth\Infrastructure\Datasource\Postgresql\User\Services;

use App\Auth\Domain\Entities\User as DomainUser;
use App\Auth\Infrastructure\Datasource\Services\ModelService;
use App\Auth\Infrastructure\Models\User;

final class RegisterService
{
    protected ModelService $modelService;

    public function __construct(ModelService $modelService)
    {
        $this->modelService = $modelService;
    }

    public function user(DomainUser $domainUser): User
    {
        $data = [
            'id' => $domainUser->id->value,
            'name' => $domainUser->name,
            'email' => $domainUser->email->value,
            'password' => $domainUser->getHashedPassword(),
        ];

        return $this->modelService->create(new User(), $data);
    }
}
