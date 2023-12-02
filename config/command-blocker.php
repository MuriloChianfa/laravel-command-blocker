<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Decids if hide the commands
    |--------------------------------------------------------------------------
    |
    | Here you can decide if hide commands in their environments from the command list.
    |
    | Supported: "true", "false"
    |
    */

    'hide' => true,

    /*
    |--------------------------------------------------------------------------
    | Decids if block the commands
    |--------------------------------------------------------------------------
    |
    | Here you can decide if block commands from execution in their environments.
    | or if only hide in the command list
    |
    | Supported: "true", "false"
    |
    */

    'block' => true,

    /*
    |--------------------------------------------------------------------------
    | Environments commands to block
    |--------------------------------------------------------------------------
    |
    | This option controls which commands will be blocked in certain environments.
    |
    */

    'environments' => [
        /**
         * Hide development commands in production environments.
         */
        'production' => [
            'db',
            'test',
            'serve',
            'docs',
            'inspire',
            'clear-compiled',
            'tinker',
            'db:seed',
            'db:wipe',
            'cache:table',
            'key:generate',
            'lang:publish',
            'make:cast',
            'make:channel',
            'make:command',
            'make:component',
            'make:controller',
            'make:event',
            'make:exception',
            'make:factory',
            'make:job',
            'make:listener',
            'make:mail',
            'make:middleware',
            'make:migration',
            'make:model',
            'make:notification',
            'make:observer',
            'make:policy',
            'make:provider',
            'make:request',
            'make:resource',
            'make:rule',
            'make:scope',
            'make:seeder',
            'make:test',
            'make:view',
            'event:generate',
            'migrate:reset',
            'migrate:fresh',
            'migrate:install',
            'migrate:refresh',
            'queue:table',
            'queue:batches-table',
            'queue:failed-table',
            'session:table',
            'stub:publish',
            'schema:dump',
            'vendor:publish',
            'package:discover',
            'notifications:table',
        ],
    ],

];
