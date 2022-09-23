<?php

namespace App\Providers;

use App\Services\CategoryService;
use App\Services\Interfaces\CategoryInterface;
use Illuminate\Support\ServiceProvider;

class ServicesProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(CategoryInterface::class, CategoryService::class);
    }
}
