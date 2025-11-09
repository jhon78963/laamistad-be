<?php

declare(strict_types=1);

namespace App\Auth\Infrastructure\Datasource\Postgresql\Auth;

use App\Auth\Domain\Entities\Login;
use App\Auth\Domain\Entities\Logout;
use App\Auth\Domain\Entities\RefreshToken;
use App\Auth\Infrastructure\Datasource\IAuthDatasource;
use App\Auth\Infrastructure\Datasource\Postgresql\Auth\Services\GoogleService;
use App\Auth\Infrastructure\Datasource\Postgresql\Auth\Services\LoginService;
use App\Auth\Infrastructure\Datasource\Postgresql\Auth\Services\LogoutService;
use App\Auth\Infrastructure\Datasource\Postgresql\Auth\Services\RefreshTokenService;
use App\Auth\Infrastructure\Datasource\Services\ResponseService;

final class AuthDatasource implements IAuthDatasource
{
    protected GoogleService $googleService;
    protected LoginService $loginService;
    protected LogoutService $logoutService;
    protected RefreshTokenService $refreshTokenService;
    protected ResponseService $responseService;

    public function __construct(
        GoogleService $googleService,
        LoginService $loginService,
        LogoutService $logoutService,
        RefreshTokenService $refreshTokenService,
        ResponseService $responseService
    ) {
        $this->googleService = $googleService;
        $this->googleService = $googleService;
        $this->loginService = $loginService;
        $this->logoutService = $logoutService;
        $this->refreshTokenService = $refreshTokenService;
        $this->responseService = $responseService;
    }

    public function login(Login $login): array
    {
        $credentials = $this->loginService->extractCredentials($login);
        $key = $this->loginService->getCacheKey($login);
        if ($this->loginService->validateCredentials($credentials)) {
            return $this->loginService->handleFailedLogin($key, $login);
        }
        $this->loginService->unblockUser($login);

        return $this->responseService->generateAccessTokenResponse(
            auth('api')->user()
        );
    }

    public function googleLogin(string $googleToken): array
    {
        $payload = $this->googleService->getGooglePayload($googleToken);
        $user = $this->googleService->getGoogleUser($payload);

        return $this->responseService->generateAccessTokenResponse($user);
    }

    public function logout(Logout $logout): void
    {
        $this->logoutService->logout($logout);
    }

    public function refreshToken(RefreshToken $refreshToken): array
    {
        $accessToken = $refreshToken->accessToken;
        $refreshToken = $refreshToken->refreshToken;
        $this->refreshTokenService->validateRefreshToken($refreshToken);
        $payload = $this->refreshTokenService->getPayloadFromRefreshToken($refreshToken);
        $user = $this->refreshTokenService->getUserFromRefreshToken($payload);

        return $this->responseService->generateRefreshTokenResponse(
            $user,
            $accessToken,
            $refreshToken,
        );
    }
}
