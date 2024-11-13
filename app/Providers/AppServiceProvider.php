<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\UsuarioRepositoryInterface;
use App\Repositories\UsuarioRepository;
use App\Repositories\SalaRepositoryInterface;
use App\Repositories\SalaRepository;
use App\Repositories\ReservaRepositoryInterface;
use App\Repositories\ReservaRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(UsuarioRepositoryInterface::class, UsuarioRepository::class);
        $this->app->bind(SalaRepositoryInterface::class, SalaRepository::class);
        $this->app->bind(ReservaRepositoryInterface::class, ReservaRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
