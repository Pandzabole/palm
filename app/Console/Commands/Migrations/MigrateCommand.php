<?php

namespace App\Console\Commands\Migrations;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Database\Console\Migrations\MigrateCommand as BaseMigrateCommand;
use Illuminate\Database\Migrations\Migrator;
use Illuminate\Support\Facades\DB;

class MigrateCommand extends BaseMigrateCommand
{
    /** @var string $connection */
    private $connection;

    /**
     * MigrateContent constructor.
     *
     * @param Migrator $migrator
     * @param Dispatcher $dispatcher
     */
    public function __construct(Migrator $migrator, Dispatcher $dispatcher)
    {
        $this->signature .= "
                {--content : Run migrations in all available content.}
                {--contents= : Run migrations in given schemas.}
        ";

        $this->connection = DB::getDefaultConnection();

        parent::__construct($migrator, $dispatcher);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($this->option('content')) {
            $this->runFor();
        } elseif ($schemas = $this->option('contents')) {
            $this->runFor($schemas);
        } else {
            parent::handle();
        }
    }

    /**
     * Run migrations in given schemas.
     *
     * @param array $schemas
     * @return void
     */
    protected function runFor(array $schemas = null): void
    {
        $schemas = $schemas ?? array_values(config('content-connections'));
        $defaultSchema = config("database.connections.$this->connection.database");
        $this->input->setOption('path', 'database/migrations/content');

        foreach ($schemas as $schema) {
            $this->connectUsingSchema($schema);

            $this->comment("\nDatabase: " . $schema);

            parent::handle();
        }

        // Reset schema.
        $this->connectUsingSchema($defaultSchema);
    }

    /**
     * Set schema.
     *
     * @param string $schema
     */
    protected function connectUsingSchema(string $schema): void
    {
        config(["database.connections.$this->connection.database" => $schema]);
        $this->getLaravel()['db']->purge();
    }
}
