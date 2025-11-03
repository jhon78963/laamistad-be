<?php

declare(strict_types=1);

namespace App\Auth\Application\DTO;

final class LoginDto
{
    public string $email;
    public string $password;
    public string $ip;

    public function __construct(array $data)
    {
        $this->email = $data['email'] ?? '';
        $this->password = $data['password'] ?? '';
        $this->ip = $data['ip'] ?? '';
    }
}
