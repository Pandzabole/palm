<?php

namespace App\Providers;

use App\Console\Commands\Migrations\FreshCommand;
use App\Console\Commands\Migrations\MigrateCommand;
use App\Console\Commands\Migrations\RollbackCommand;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Database\Migrations\Migrator;
use Illuminate\Database\MigrationServiceProvider as BaseMigrationServiceProvider;

class MigrationServiceProvider extends BaseMigrationServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        parent::register();

        $this->registerMigrateCommand();
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerMigrateCommand(): void
    {
        $this->app->singleton('command.migrate', function ($app) {
            return new MigrateCommand($app['migrator'], $app[Dispatcher::class]);
        });

        $this->app->singleton(Migrator::class, function ($app) {
            return $app['migrator'];
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerMigrateFreshCommand(): void
    {
        $this->app->singleton('command.migrate.fresh', function () {
            return new FreshCommand();
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerMigrateRollbackCommand(): void
    {
        $this->app->singleton('command.migrate.rollback', function ($app) {
            return new RollbackCommand($app['migrator']);
        });
    }
}
