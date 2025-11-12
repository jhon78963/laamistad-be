<?php

declare(strict_types=1);

namespace App\Auth\Domain\Entities;

final class Role
{
    /**
     * @property int $id
     * @property string $description
     */
    public function __construct(
        public readonly string $id,
        public readonly string $description
    ) {}
}
