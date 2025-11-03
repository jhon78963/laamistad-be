<?php

declare(strict_types=1);

namespace App\Auth\Infrastructure\Datasource\Postgresql\Services;

use App\Auth\Domain\Entities\Register;
use App\Auth\Infrastructure\Datasource\Services\ModelService;
use App\Auth\Infrastructure\Models\User;
use Hash;

final class RegisterService
{
    protected ModelService $modelService;

    public function __construct(ModelService $modelService)
    {
        $this->modelService = $modelService;
    }

    public function user(Register $register): User
    {
        $data = [
            'email' => $register->email,
            'password' => Hash::make($register->password),
            'headquarter_id' => $register->headquarterId,
            'user_type_id' => $register->userTypeId,
        ];

        return $this->modelService->create(new User(), $data);
    }
}
