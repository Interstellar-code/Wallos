<?php

namespace App\Providers;

use Illuminate\Database\Connection;
use Illuminate\Database\Connectors\ConnectionFactory;
use Illuminate\Database\DatabaseServiceProvider as BaseDatabaseServiceProvider;
use App\Database\CustomConnection;

class DatabaseServiceProvider extends BaseDatabaseServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // Register the connection factory
        $this->app->singleton('db.factory', function ($app) {
            return new ConnectionFactory($app);
        });

        // Register the custom connection
        $this->app->singleton('db.connection', function ($app) {
            return new CustomConnection(
                $app['db.factory'],
                $app['config']['database']
            );
        });

        // Register the original database services
        parent::register();
    }
}