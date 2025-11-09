<?php
namespace App\Auth\Domain\Exceptions;

class UserAlreadyExistsException extends \DomainException
{
    public function __construct()
    {
        parent::__construct('El email ya está registrado.');
    }
}
