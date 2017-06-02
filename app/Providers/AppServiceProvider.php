<?php

namespace App\Providers;

use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Iber\Generator\ModelGeneratorProvider;
use Illuminate\Support\ServiceProvider;
use Way\Generators\GeneratorsServiceProvider;
use Xethron\MigrationsGenerator\MigrationsGeneratorServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(IdeHelperServiceProvider::class);
            $this->app->register(GeneratorsServiceProvider::class);
            $this->app->register(MigrationsGeneratorServiceProvider::class);
            $this->app->register(ModelGeneratorProvider::class);
        }
    }
}
