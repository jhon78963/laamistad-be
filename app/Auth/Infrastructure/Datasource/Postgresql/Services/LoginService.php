<?php

declare(strict_types=1);

namespace App\Auth\Infrastructure\Datasource\Postgresql\Services;

use App\Auth\Infrastructure\Models\LoginBlock;
use App\Auth\Domain\Entities\Login;
use App\Auth\Infrastructure\Datasource\Services\ModelService;
use Carbon\Carbon;

final class LoginService
{
    private const MAX_ATTEMPTS = 5;
    private const BLOCK_HOURS = 2;
    protected ModelService $modelService;

    public function __construct(ModelService $modelService)
    {
        $this->modelService = $modelService;
    }

    public function extractCredentials(Login $login): array
    {
        return [
            'email' => $login->email,
            'password' => $login->password,
        ];
    }

    public function validateCredentials(array $credentials): bool
    {
        return !auth('api')->attempt($credentials);
    }

    public function getCacheKey(Login $login): string
    {
        return "login_attempts:{$login->ip}:{$login->email}";
    }

    public function handleFailedLogin(string $key, Login $login): array
    {
        $attempts = cache()->increment($key, 1);
        cache()->put($key, $attempts, now()->addHours(self::BLOCK_HOURS));

        if ($attempts >= self::MAX_ATTEMPTS) {
            $this->blockUser($login);
            cache()->forget($key);

            return [
                'message' => "Has superado el número máximo de intentos. Tu acceso estará bloqueado por " . self::BLOCK_HOURS . " horas.",
                'code' => 429,
            ];
        }

        return [
            'message' => "Credenciales inválidas. Intento $attempts de " . self::MAX_ATTEMPTS,
            'code' => 401,
        ];
    }

    public function blockUser(Login $login): void
    {
        $data = [
            'ip' => $login->ip,
            'email' => $login->email,
            'blocked_since' => Carbon::now(),
            'blocked_until' => Carbon::now()->addHours(self::BLOCK_HOURS),
        ];
        $this->modelService->create(new LoginBlock(), $data);
    }

    public function unblockUser(Login $login): void
    {
        $loginBlock = LoginBlock::where('ip', $login->ip)
            ->where('email', $login->email)
            ->first();

        if ($loginBlock) {
            $this->modelService->update($loginBlock, [
                'unblocked_at' => now(),
            ]);
        }
    }
}
