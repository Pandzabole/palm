<?php

namespace App\Console\Commands\Migrations;

use Illuminate\Database\Console\Migrations\RollbackCommand as BaseRollbackCommand;
use Illuminate\Database\Migrations\Migrator;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\InputOption;

class RollbackCommand extends BaseRollbackCommand
{
    /** @var string $connection */
    private $connection;

    /**
     * Create a new migration rollback command instance.
     *
     * @param Migrator $migrator
     * @return void
     */
    public function __construct(Migrator $migrator)
    {
        parent::__construct($migrator);

        $this->connection = DB::getDefaultConnection();
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

    /**
     * Get the console command options.
     *
     * @return array
     */
    public function getOptions(): array
    {
        $options = [
            ['contents', null, InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY, 'The contents(s) to the migrations files to be executed'],
            ['content', null, InputOption::VALUE_NONE, 'The content to the migrations files to be executed'],
        ];

        return array_merge(parent::getOptions(), $options);
    }
}
