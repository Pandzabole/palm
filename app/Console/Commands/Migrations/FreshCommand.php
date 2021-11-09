<?php

namespace App\Console\Commands\Migrations;

use Database\Seeders\ContentSeeder;
use Illuminate\Database\Console\Migrations\FreshCommand as BaseFreshCommand;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\InputOption;

class FreshCommand extends BaseFreshCommand
{
    /** @var string $connection */
    private $connection;

    /**
     * FreshCommand constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->connection = DB::getDefaultConnection();
    }

    /**
     * Execute the console command.
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

        if ($this->option('seed')) {
            $this->input->setOption('seeder', ContentSeeder::class);
        }

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
