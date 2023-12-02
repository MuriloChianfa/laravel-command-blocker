<?php

declare(strict_types=1);

namespace MuriloChianfa\LaravelCommandBlocker;

use Illuminate\Support\ServiceProvider;
use MuriloChianfa\LaravelCommandBlocker\CommandBlocker;

/**
 * Provide a basic package configuration.
 *
 * @method boot
 * @method register
 */
final class CommandBlockerServiceProvider extends ServiceProvider
{
    const PACKAGE_CONFIG = 'config/command-blocker.php';
    const CONFIG_PATH = __DIR__ . '/../' . self::PACKAGE_CONFIG;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        if (!$this->app->runningInConsole()) {
            return;
        }

        $this->publishes([
            self::CONFIG_PATH => base_path(self::PACKAGE_CONFIG),
        ], 'config');

        CommandBlocker::handle();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(self::CONFIG_PATH, 'command-blocker');
    }
}
