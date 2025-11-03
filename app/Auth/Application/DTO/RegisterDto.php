<?php

declare(strict_types=1);

namespace App\Auth\Application\DTO;

final class RegisterDto
{
    public readonly string $firstName;
    public readonly string $otherNames;
    public readonly string $fatherSurname;
    public readonly string $motherSurname;
    public readonly int $cellphoneCodeId;
    public readonly string $cellphoneNumber;
    public readonly int $documentTypeId;
    public readonly string $documentNumber;
    public readonly string $email;
    public readonly string $password;
    public readonly int $headquarterId;
    public readonly int $userTypeId;
    public function __construct(array $data)
    {
        $this->firstName = $data['firstName'] ?? '';
        $this->otherNames = $data['otherNames'] ?? '';
        $this->fatherSurname = $data['fatherSurname'] ?? '';
        $this->motherSurname = $data['motherSurname'] ?? '';
        $this->cellphoneCodeId = $data['cellphoneCodeId'] ?? 1;
        $this->cellphoneNumber = $data['cellphoneNumber'] ?? '';
        $this->documentTypeId = $data['documentTypeId'] ?? 1;
        $this->documentNumber = $data['documentNumber'] ?? '';
        $this->email = $data['email'] ?? '';
        $this->password = $data['password'] ?? '';
        $this->headquarterId = $data['headquarterId'] ?? 1;
        $this->userTypeId = $data['userTypeId'] ?? 1;
    }
}
