<?php

declare(strict_types=1);

namespace MuriloChianfa\LaravelCommandBlocker;

use Artisan;
use ReflectionObject;
use Illuminate\Support\Facades\Event;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Console\Events\CommandStarting;

/**
 * Main functions for block commands.
 *
 * @method handle
 */
final class CommandBlocker
{
    /** @var static $commands List of all commands in application */
    private static $commands = [];

    /**
     * Load all commands to block.
     *
     * @return void
     * @static
     */
    public static function handle(): void
    {
        Event::listen(CommandStarting::class, function (CommandStarting $event) {
            self::$commands = Artisan::all();

            foreach (array_keys(config('command-blocker.environments')) as $environment) {
                self::verify($environment, $event->command);
            }
        });
    }

    /**
     * Verify if current environment have any command to block.
     *
     * @return void
     * @static
     */
    private static function verify(string $environment, string $triggered): void
    {
        if (config('app.env') !== $environment) {
            return;
        }

        foreach (config('command-blocker.environments.' . $environment) as $command) {
            self::block($command, $triggered);

            try {
                self::hide($command);
            } catch (\Throwable $th) {
                continue;
            }
        }
    }

    /**
     * Block commands for specific environments.
     *
     * @param string $command
     * @param string $triggered
     * @return void
     * @static
     */
    private static function block(string $command, string $triggered): void
    {
        if (!config('command-blocker.block') || $triggered !== $command) {
            return;
        }

        echo 'This command was blocked for this environment' . PHP_EOL;
        exit;
    }

    /**
     * Hide commands for specific environments.
     *
     * @param string $command
     * @return void
     * @static
     */
    private static function hide(string $command): void
    {
        if (!config('command-blocker.hide')) {
            return;
        }

        $object = self::$commands[$command];
        $class = new ReflectionObject($object);

        if (!$class->hasProperty('hidden')) {
            return;
        }

        $class->getProperty('hidden')->setValue($object, true);
    }
}
