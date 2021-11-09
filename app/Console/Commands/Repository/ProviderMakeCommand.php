<?php

namespace App\Console\Commands\Repository;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class ProviderMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:repository-provider';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make repository provider';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'class';

    /**
     * ProviderMakeCommand constructor.
     * @param Filesystem $files
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct($files);

        $files->delete(base_path('app/Providers/RepositoryServiceProvider.php'));
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub(): string
    {
        return base_path('stubs/RepositoryServiceProvider.stub');
    }

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Providers';
    }

    /**
     * Replace the class name for the given stub.
     *
     * @param string $stub
     * @param string $name
     * @return string
     * @throws \JsonException
     */
    protected function replaceClass($stub, $name): string
    {
        $class = str_replace($this->getNamespace($name) . '\\', '', $name);

        $stub = $this->generateBindings($stub);

        return str_replace(['DummyClass', '{{ class }}', '{{class}}'], $class, $stub);
    }

    /**
     * @param $stub
     * @return string
     * @throws \JsonException
     */
    protected function generateBindings($stub): string
    {
        $repos = $this->getRepositories();
        $bindings = '';
        foreach ($repos as $repo) {
            $bindings .= $this->getBindingString($repo);
        }

        return str_replace('{bindings}', $bindings, $stub);
    }

    /**
     * @throws \JsonException
     */
    protected function getRepositories()
    {
        return json_decode(file_get_contents(base_path('stubs/repo-bindings.json')), true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * @param $repo
     * @return string
     */
    protected function getBindingString($repo): string
    {
        $model = data_get($repo, 'model');
        $name = data_get($repo, 'repo') ?: Str::plural($model);

        return "\$this->app->singleton(
            \\App\\Repositories\\Contracts\\" . $name . "Repository::class,
             static function () {
                return new \\App\\Repositories\\" . $name . "Repository(new \\App\Models\\" . $model . "());
        });\n";
    }
}
