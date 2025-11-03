<?php

declare(strict_types=1);

namespace App\Auth\Interfaces\Controllers;

use App\Auth\Application\DTO\LoginDto;
use App\Auth\Application\DTO\LogoutDto;
use App\Auth\Application\DTO\RefreshTokenDto;
use App\Auth\Application\DTO\RegisterDto;
use App\Auth\Application\UseCases\GoogleLoginUseCase;
use App\Auth\Application\UseCases\LoginUseCase;
use App\Auth\Application\UseCases\LogoutUseCase;
use App\Auth\Application\UseCases\RefreshTokenUseCase;
use App\Auth\Application\UseCases\RegisterUseCase;
use App\Auth\Interfaces\Controllers\Controller;
use App\Auth\Interfaces\Requests\GoogleLoginRequest;
use App\Auth\Interfaces\Requests\LoginRequest;
use App\Auth\Interfaces\Requests\LogoutRequest;
use App\Auth\Interfaces\Requests\RefreshTokenRequest;
use App\Auth\Interfaces\Requests\RegisterRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

final class AuthController extends Controller
{
    protected GoogleLoginUseCase $googleLoginUseCase;
    protected LoginUseCase $loginUseCase;
    protected LogoutUseCase $logoutUseCase;
    protected RefreshTokenUseCase $refreshTokenUseCase;
    protected RegisterUseCase $registerUseCase;

    public function __construct(
        GoogleLoginUseCase $googleLoginUseCase,
        LoginUseCase $loginUseCase,
        LogoutUseCase $logoutUseCase,
        RefreshTokenUseCase $refreshTokenUseCase,
        RegisterUseCase $registerUseCase,
    ) {
        $this->googleLoginUseCase = $googleLoginUseCase;
        $this->loginUseCase = $loginUseCase;
        $this->logoutUseCase = $logoutUseCase;
        $this->refreshTokenUseCase = $refreshTokenUseCase;
        $this->registerUseCase = $registerUseCase;
    }

    public function login(LoginRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $loginDto = new LoginDto([
                'email' => $request->email,
                'password' => $request->password,
                'ip' => $request->ip()
            ]);
            $login = $this->loginUseCase->execute($loginDto);
            DB::commit();
            return response()->json($login);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json($e->getMessage(), 500);
        }
    }

    public function googleLogin(GoogleLoginRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $googleLogin = $this->googleLoginUseCase->execute($request->token);
            DB::commit();
            return response()->json($googleLogin);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json($e->getMessage(), 500);
        }
    }

    public function logout(LogoutRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $logoutDto = new LogoutDto($request->validated());
            $this->logoutUseCase->execute($logoutDto);
            DB::commit();
            return response()->json(['message' => 'Successfully logged out']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json($e->getMessage(), 500);
        }
    }

    public function refreshToken(RefreshTokenRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $refreshTokenDto = new RefreshTokenDto($request->validated());
            $refreshToken = $this->refreshTokenUseCase->execute($refreshTokenDto);
            DB::commit();
            return response()->json($refreshToken);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json($e->getMessage(), 500);
        }
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $registerDto = new RegisterDto($request->validated());
            $register = $this->registerUseCase->execute($registerDto);
            DB::commit();
            return response()->json($register, 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json($e->getMessage(), 500);
        }
    }
}
