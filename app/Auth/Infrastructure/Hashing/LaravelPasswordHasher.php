<?php

namespace App\Auth\Infrastructure\Hashing;

use App\Auth\Application\Contracts\PasswordHasher;
use Illuminate\Support\Facades\Hash;

final class LaravelPasswordHasher implements PasswordHasher
{
    public function hash(string $plainPassword): string
    {
        return Hash::make($plainPassword);
    }
}
