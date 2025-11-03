<?php

declare(strict_types=1);

namespace App\Auth\Domain\Entities;

final class RefreshToken
{
    /**
     * RefreshToken constructor.
     *
     * @param string $accessToken
     * @param string $refreshToken
     */
    public function __construct(
        public readonly string $accessToken,
        public readonly string $refreshToken,
    ) {
    }
}
