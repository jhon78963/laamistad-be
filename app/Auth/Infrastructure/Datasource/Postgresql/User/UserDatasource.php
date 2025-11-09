<?php

declare(strict_types=1);

namespace App\Auth\Infrastructure\Datasource\Postgresql\User;

use App\Auth\Domain\Entities\User;
use App\Auth\Domain\ValueObjects\Email;
use App\Auth\Domain\ValueObjects\UserId;
use App\Auth\Infrastructure\Datasource\IUserDatasource;
use App\Auth\Infrastructure\Datasource\Postgresql\User\Services\FindByEmailService;
use App\Auth\Infrastructure\Datasource\Postgresql\User\Services\RegisterService;
use App\Auth\Infrastructure\Datasource\Services\ResponseService;

final class UserDatasource implements IUserDatasource
{
    protected FindByEmailService $findByEmailService;
    protected RegisterService $registerService;
    protected ResponseService $responseService;

    public function __construct(
        FindByEmailService $findByEmailService,
        RegisterService $registerService,
        ResponseService $responseService,
    ) {
        $this->findByEmailService = $findByEmailService;
        $this->registerService = $registerService;
        $this->responseService = $responseService;
    }

    public function nextIdentity(): UserId
    {
        return UserId::next();
    }

    public function findByEmail(Email $email): ?User
    {
        return $this->findByEmailService->getUser($email);
    }

    public function save(User $user): array
    {
        $userModel = $this->registerService->user($user);
        return $this->responseService->generateAccessTokenResponse($userModel);
    }
}
