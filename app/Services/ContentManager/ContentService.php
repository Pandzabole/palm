<?php

namespace App\Services\ContentManager;

use Illuminate\Support\Facades\DB;

class ContentService
{
    /**
     * @param string $connection
     * @param $connectionSchema
     */
    public function setConnectionDatabase(string $connection, $connectionSchema = null): void
    {
        $connectionSchema = $connectionSchema ?? config('database.default_database');
        config(["database.connections.$connection.database" => $connectionSchema]);
        app()['db']->purge();
    }

    /**
     * @return void
     */
    public function setDefaultConnectionDatabase(): void
    {
        $connection = config('database.default');
        $connectionSchema = config('database.default_database');

        $this->setConnectionDatabase($connection, $connectionSchema);
    }

    /**
     * @return string
     */
    public function getCurrentConnectionDatabase(): string
    {
        $connection = DB::getDefaultConnection();

        return config("database.connections.$connection.database");
    }
}
