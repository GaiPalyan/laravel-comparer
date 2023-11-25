<?php

declare(strict_types=1);

namespace Gai\Comparer;

use Illuminate\Support\ServiceProvider;

class ComparerServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->configurePublishing();
    }

    public function configurePublishing(): void
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->publishes([
            __DIR__.'/../config/comparer.php' => config_path('comparer.php'),
        ], 'config');
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/comparer.php', 'comparer');

        $this->app->singleton('comparer', fn () => new Comparer);
    }

    public function provides(): array
    {
        return ['comparer'];
    }
}
