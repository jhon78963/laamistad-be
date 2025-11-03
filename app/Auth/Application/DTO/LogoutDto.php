<?php

declare(strict_types=1);

namespace App\Auth\Application\DTO;

final class LogoutDto
{
    public string $accessToken;
    public string $refreshToken;

    public function __construct(array $data)
    {
        $this->accessToken = $data['accessToken'] ?? '';
        $this->refreshToken = $data['refreshToken'] ?? '';
    }
}
