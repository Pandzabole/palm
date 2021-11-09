<?php

namespace App\Console\Commands\Repository;

use Illuminate\Console\Command;

class ListRepository extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository-list {name} {repo?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add repo to the list';

    /**
     * Execute the console command.
     *
     * @return int
     * @throws \JsonException
     */
    public function handle(): int
    {
        $name = $this->argument('name');
        $repo = $this->argument('repo');

        $this->listNewRepository($name, $repo);

        $this->info('repository listed');

        return 0;
    }

    /**
     * @param $name
     * @param null $repo
     * @return false|int
     * @throws \JsonException
     */
    protected function listNewRepository($name, $repo)
    {
        $repositoryList = $this->getRepositories();

        $repositoryList[] = ['model' => $name, 'repo' => $repo];

        return $this->saveRepositories(json_encode($repositoryList, JSON_THROW_ON_ERROR));
    }

    /**
     * @throws \JsonException
     */
    protected function getRepositories()
    {
        return json_decode(file_get_contents(base_path('stubs/repo-bindings.json')), true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * @param string $repositoryList
     * @return false|int
     */
    protected function saveRepositories(string $repositoryList)
    {
        return file_put_contents(base_path('stubs/repo-bindings.json'), $repositoryList);
    }
}
