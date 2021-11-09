<?php

namespace Tests\Feature\Middleware;

use App\Http\Middleware\CheckLanguageAPI;
use App\Models\Language;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Tests\ContentTestCase;

class CheckLanguageAPITest extends ContentTestCase
{
    /** @var Collection $languages */
    private $languages;

    /**
     * @param string|null $name
     * @param array $data
     * @param int|string $dataName
     *
     * @internal This method is not covered by the backward compatibility promise for PHPUnit
     */
    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->withContent = false;

        $this->withLanguages = false;
        $this->languages = collect();
    }

    /**
     * @test
     * @return void
     * @throws BindingResolutionException
     */
    public function it_sets_default_connection(): void
    {
        // arrange
        $this->setLanguages();
        $middleware = $this->app->make(CheckLanguageAPI::class);
        $request = $this->app->make(Request::class);

        // act
        $middleware->handle($request, static function () {
        });

        // assert
        self::assertEquals($this->getDefaultLanguage()->connection_name, $this->getDefaultSchema());
    }

    /**
     * @test
     * @return void
     * @throws BindingResolutionException
     */
    public function it_sets_selected_language_connection(): void
    {
        // arrange
        $this->setLanguages();
        $selectedLanguage = $this->languages->random();
        $middleware = $this->app->make(CheckLanguageAPI::class);
        $request = $this->app->make(Request::class);

        $request->request->set('lang', $selectedLanguage->short);

        // act
        $middleware->handle($request, static function () {
        });

        // assert
        self::assertEquals($selectedLanguage->connection_name, $this->getDefaultSchema());
    }

    /**
     * @return void
     */
    private function setLanguages(): void
    {
        $counter = 0;
        $this->schemas->each(function ($schema) use (&$counter) {
            $this->languages->push(
                Language::factory()
                    ->create(['short' => $schema, 'connection_name' => $schema, 'default' => $counter])
            );
            $counter++;
        });
    }

    /**
     * @return mixed
     */
    private function getDefaultLanguage()
    {
        return $this->languages->firstWhere('default');
    }

    /**
     * @return string
     */
    private function getDefaultSchema(): string
    {
        $connection = DB::getDefaultConnection();

        return config("database.connections.$connection.database");
    }
}
