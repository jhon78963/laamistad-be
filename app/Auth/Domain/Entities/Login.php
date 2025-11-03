<?php

declare(strict_types=1);

namespace App\Auth\Domain\Entities;

final class Login
{
    /**
     * Login constructor.
     *
     * @param string $email
     * @param string $password
     * @param string $ip
     */
    public function __construct(
        public readonly string $email,
        public readonly string $password,
        public readonly string $ip,
    ) {
    }
}
