<?php

declare(strict_types=1);

namespace App\Auth\Interfaces\Controllers;

use App\Auth\Application\UseCases\GetUserRoleUseCase;
use App\Auth\Domain\ValueObjects\UserId;
use App\Auth\Interfaces\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class UserController extends Controller
{
    public function __construct(
        private readonly GetUserRoleUseCase $getUserRoleUseCase
    ) {}

    public function getRole(Request $request): JsonResponse
    {
        $userId = new UserId((string) $request->user()->id);

        $role = $this->getUserRoleUseCase->execute($userId);

        if (!$role) {
            return response()->json(['message' => 'Rol no encontrado'], 404);
        }

        return response()->json([
            'role' => $role->description,
        ]);
    }
}
