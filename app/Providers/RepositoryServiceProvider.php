<?php

declare(strict_types=1);

namespace App\Providers;

use App\Auth\Domain\Repositories\IAuthRepository;
use App\Auth\Infrastructure\Datasource\IAuthDatasource;
use App\Auth\Infrastructure\Datasource\Postgresql\AuthDatasource;
use App\Auth\Infrastructure\Repositories\AuthRepository;
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
    }
}
