<?php

declare(strict_types=1);

namespace App\Providers;

use App\Auth\Application\Contracts\PasswordHasher;
use App\Auth\Domain\Repositories\IAuthRepository;
use App\Auth\Domain\Repositories\IUserRepository;
use App\Auth\Infrastructure\Datasource\IAuthDatasource;
use App\Auth\Infrastructure\Datasource\IUserDatasource;
use App\Auth\Infrastructure\Datasource\Postgresql\Auth\AuthDatasource;
use App\Auth\Infrastructure\Datasource\Postgresql\User\UserDatasource;
use App\Auth\Infrastructure\Hashing\LaravelPasswordHasher;
use App\Auth\Infrastructure\Repositories\AuthRepository;
use App\Auth\Infrastructure\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

final class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            IAuthRepository::class,
            AuthRepository::class
        );
        $this->app->bind(
            IAuthDatasource::class,
            AuthDatasource::class
        );
        $this->app->bind(
            IUserRepository::class,
            UserRepository::class
        );
        $this->app->bind(
            IUserDatasource::class,
            UserDatasource::class
        );
        $this->app->bind(
            PasswordHasher::class,
            LaravelPasswordHasher::class
        );
    }
}
