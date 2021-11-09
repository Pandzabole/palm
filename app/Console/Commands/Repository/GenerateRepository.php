<?php

namespace App\Console\Commands\Repository;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class GenerateRepository extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:repository';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate repository class, interface and bind to provider';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $name = $this->ask('Enter model name');
        $repo = $this->ask('If you prefer enter repo name (optional)');

        if ($name) {
            $this->generateRepository($name, $repo);
        }
        else {
            $this->error('Model name is required');
        }

        return 0;
    }

    /**
     * @param $name
     * @param null $repo
     */
    protected function generateRepository($name, $repo = null): void
    {
        $repo = $repo ?: Str::plural($name);

        $this->call('make:repository-interface', ['name' => $repo]);
        $this->call('make:repository', ['name' => $repo]);
        $this->call('make:repository-list', ['name' => $name, 'repo' => $repo]);
        $this->call('make:repository-provide', ['name' => 'RepositoryServiceProvider']);
    }
}
