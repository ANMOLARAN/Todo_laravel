<?php

namespace App\Providers;

use App\Interfaces\AdminRepositoryInterface;
use App\Interfaces\BlogRepositoryInterface;
use App\Repositories\AdminRepository;
use App\Repositories\BlogRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(BlogRepositoryInterface::class, BlogRepository::class);
        $this->app->bind(AdminRepositoryInterface::class, AdminRepository::class);
        
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
