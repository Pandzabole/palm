<?php

namespace Tests;

use App\Models\Language;
use App\Models\Publish;
use App\Models\User;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabaseState;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Testing\TestResponse;
use Laravel\Passport\Client;
use Laravel\Passport\Passport;

class ContentTestCase extends TestCase
{
    use DatabaseMigrations {
        runDatabaseMigrations as runMigration;
    }

    /** @var bool $withContent */
    protected $withContent = true;

    /** @var Collection $connections */
    protected $connections;

    /** @var Publish $publish */
    protected $publish;

    /** @var Collection $schemas */
    protected $schemas;

    /** @var string $imageUrl */
    protected $imageUrl;

    /** @var string $videoUrl */
    protected $videoUrl;

    /** @var string $testConnection */
    protected $testConnection;

    /** @var bool $withPublish */
    protected $withPublish = true;

    /** @var bool $withAuthUser */
    protected $withAuthUser = true;

    /** @var bool $withLanguages */
    protected $withLanguages = true;

    /** @var bool $withLanguageSession */
    protected $withLanguageSession = true;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp(): void
    {
        $this->testConnection = 'testing';
        $this->schemas = collect(
            [
                'testing_content' => 'testing_content',
                'testing_content_2' => 'testing_content_2',
            ]
        );
        $this->connections = $this->schemas->keys();

        parent::setUp();

        if ($this->withAuthUser) {
            $this->actingAs(User::factory()->create());
        }

        if ($this->withLanguageSession) {
            $this->withSession(['db_language' => $this->schemas->first()]);
        }

        if ($this->withLanguages) {
            $this->seedLanguage();
        }

        $this->imageUrl = config('seeder.image_url');
        $this->videoUrl = config('seeder.video_url');

        if ($this->withContent) {
            $this->setContentConnectionSchema();
            if ($this->withPublish) {
                $this->publish();
            }
        }
    }

    /**
     * Overwrite DatabaseMigrations Trait method to run migrate commands on all system migrations
     */
    public function runDatabaseMigrations(): void
    {
        $this->migrate();

        $this->app[Kernel::class]->setArtisan(null);

        $this->beforeApplicationDestroyed(
            function () {
                $this->migrate(false);
                RefreshDatabaseState::$migrated = false;
            }
        );
    }

    /**
     * Migrate fresh databases based on selection
     *
     * @param bool $fresh
     */
    private function migrate($fresh = true): void
    {
        $command = $fresh ? 'migrate:fresh' : 'migrate:rollback';
        $this->setContentConnections();

        $this->artisan($command);
        $this->artisan($command . ' --content');
    }

    /**
     * Set content connections config
     */
    private function setContentConnections(): void
    {
        Config::set('content-connections', $this->schemas->all());
    }

    /**
     * @param null $connection
     * @param null $connectionSchema
     */
    public function setContentConnectionSchema($connection = null, $connectionSchema = null): void
    {
        $connection = $connection ?? DB::getDefaultConnection();
        $connectionSchema = $connectionSchema ?? $this->schemas->first();

        config(["database.connections.$connection.database" => $connectionSchema]);

        app()['db']->purge();
    }

    /**
     * @void
     */
    public function setTestConnectionSchema(): void
    {
        $this->setContentConnectionSchema(null, $this->testConnection);
    }

    /**
     * Seed language with default connection
     */
    private function seedLanguage(): void
    {
        Language::factory()->create(['connection_name' => $this->schemas->first()]);
    }

    /**
     * @void
     */
    public function logoutUser(): void
    {
        $this->setTestConnectionSchema();
        Auth::logout();
        $this->setContentConnectionSchema();
    }

    /**
     * @void
     */
    public function publish(): void
    {
        $this->publish = Publish::factory()->create();
    }

    /**
     * Authenticate client with passport.
     *
     * @param null $client
     */
    protected function actingAsClient($client = null): void
    {
        $this->setTestConnectionSchema();

        if ($client === null) {
            $client = Client::factory()->create();
        }

        Passport::actingAsClient($client);

        $this->setContentConnectionSchema();
    }

    /**
     * @param string $route
     * @param array $data
     * @param string $method
     * @param bool $testConnectionSchema
     * @return JsonResponse|TestResponse
     */
    public function getApiJsonResponse(
        string $route,
        array $data = [],
        string $method = 'get',
        bool $testConnectionSchema = true
    ) {
        if ($testConnectionSchema) {
            $this->setTestConnectionSchema();
        }

        return $this->json($method, 'api/' . $route, $data);
    }
}
