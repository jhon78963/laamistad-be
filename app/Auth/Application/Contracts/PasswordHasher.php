<?php

declare(strict_types=1);

namespace App\Auth\Application\Contracts;

interface PasswordHasher
{
    public function hash(string $plainPassword): string;
}
