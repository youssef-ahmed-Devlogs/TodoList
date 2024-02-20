<?php

namespace App\Providers;

use App\Models\Todo;
use App\Repositories\TodoRepository;
use App\Repositories\TodoRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(TodoRepositoryInterface::class, function ($app) {
            return new TodoRepository(new Todo());
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
