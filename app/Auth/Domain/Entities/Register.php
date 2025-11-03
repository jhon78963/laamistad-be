<?php

declare(strict_types=1);

namespace App\Auth\Domain\Entities;

final class Register
{
    /**
     * Register constructor.
     *
     * @param string $firstName
     * @param string $otherNames
     * @param string $fatherSurname
     * @param string $motherSurname
     * @param int $cellphoneCodeId
     * @param string $cellphoneNumber
     * @param int $documentTypeId
     * @param string $documentNumber
     * @param string $email
     * @param string $password
     * @param int $headquarterId
     * @param int $userTypeId
     */
    public function __construct(
        public readonly string $firstName,
        public readonly string $otherNames,
        public readonly string $fatherSurname,
        public readonly string $motherSurname,
        public readonly int $cellphoneCodeId,
        public readonly string $cellphoneNumber,
        public readonly int $documentTypeId,
        public readonly string $documentNumber,
        public readonly string $email,
        public readonly string $password,
        public readonly int $headquarterId,
        public readonly int $userTypeId,
    ) {
    }
}
