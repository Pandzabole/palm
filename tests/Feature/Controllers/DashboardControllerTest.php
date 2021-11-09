<?php

namespace Feature\Controllers;

use App\Models\Language;
use App\Models\MainMarket;
use App\Models\MainMarketUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Tests\ContentTestCase;

class DashboardControllerTest extends ContentTestCase
{
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
    }

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp(): void
    {
        $this->withLanguages = false;

        parent::setUp();
    }

    /**
     * @var Collection $languages
     */
    private $languages;

    /**
     * @var Collection $users
     */
    private $users;

    /**
     * @test
     */
    public function it_shows_dashboard_page(): void
    {
        // act
        $response = $this->get(route('dashboard'));

        // assert
        $response->assertSuccessful();
        $response->assertViewIs('admin.dashboard');
    }

    /**
     * @test
     */
    public function it_redirects_if_language_not_selected(): void
    {
        // act
        $response = $this->withSession(['db_language' => ''])->get(route('dashboard'));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('language'));
    }

    /**
     * @test
     */
    public function it_shows_languages_page(): void
    {
        // arrange
        $this->setLanguages(4);
        $markets = $this->setUsers(4)->first()->mainMarkets;

        // act
        $response = $this->get(route('language'));
        $data = $response->viewData('markets');

        // assert
        $response->assertSuccessful();
        $response->assertViewIs('admin.languages');
        $response->assertViewHas('markets');
        foreach ($markets as $key => $market) {
            self::assertEquals($market->name, $data[$key]->name);
        }
    }

    /**
     * @test
     */
    public function it_fails_to_show_languages_page_if_user_not_logged_in(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->get(route('language'));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_sets_selected_language_as_default_database_connection(): void
    {
        // arrange
        $this->setLanguages(3);
        $selectedLanguage = Language::factory()->create(['connection_name' => $this->testConnection]);

        // act
        $response = $this->get(route('set-language', ['lang' => $selectedLanguage->short]));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('dashboard'));
        $response->assertSessionHas('db_language', $selectedLanguage->connection_name);
        $response->assertSessionHas('db_language_name', $selectedLanguage->short);
        self::assertEquals($selectedLanguage->connection_name, DB::getDefaultConnection());
    }

    /**
     * @test
     */
    public function it_fails_to_set_default_database_connection_with_wrong_language_code(): void
    {
        // arrange
        $this->setLanguages(3);

        // act
        $response = $this->get(route('set-language', ['lang' => 'dummy']));

        // assert
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['lang']);
    }

    /**
     * @param int $count
     */
    private function setLanguages($count = 5): void
    {
        $this->languages = Language::factory()->count($count)->create();
    }

    /**
     * @param int $count
     * @return Collection
     */
    public function setUsers($count = 1): Collection
    {
        $this->setMarkets();
        $this->setMainMarketUser();
        return User::factory()->roleMicroAdmin()->count($count)->create()->load('mainMarkets');
    }

    /**
     * @param int $count
     * @return Collection
     */
    public function setMarkets($count = 4): Collection
    {
        return MainMarket::factory()->count($count)->create();
    }

    /**
     * @param int $count
     * @return Collection
     */
    public function setMainMarketUser($count = 2): Collection
    {
        return MainMarketUser::factory()->count($count)->create();
    }
}
