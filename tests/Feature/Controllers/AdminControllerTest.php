<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\MainMarket;
use Database\Factories\MainMarketFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Tests\ContentTestCase;

class AdminControllerTest extends ContentTestCase
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
     * @test
     */
    public function it_shows_admins_view_on_index(): void
    {
        // act
        $response = $this->get(route('admins.index'));

        // assert
        $response->assertSuccessful();
        $response->assertViewIs('admin.admins.index');
    }

    /**
     * @test
     */
    public function it_shows_admins_data_on_index(): void
    {
        // arrange
        $admins = $this->setUsers(3);

        // act
        $response = $this->json('get', route('admins.data'));
        $data = $response->getData()->data;

        // assert
        $response->assertSuccessful();
        foreach ($admins as $key => $admin) {
            self::assertEquals($admin->name, $data[$key]->name);
            self::assertEquals($admin->role_name, $data[$key]->admin_privileges);
        }
    }

    /**
     * @test
     */
    public function it_return_markets_on_create_page(): void
    {
        // arrange
        $markets = $this->setMarkets();
        $userRole = $this->setUsers(3)->first()->role_id;

        //act
        $response = $this->json('post', route('admins.markets'), ['role_id' => $userRole]);
        $data = $response->json();

        //assert
        $response->assertSuccessful();
        $response->assertStatus(200);
        $response->assertJson($data, $strict = false);
        foreach ($markets as $key => $market) {
            self::assertEquals($market->name, $data['markets'][$key]['name']);
            self::assertEquals($market->href, $data['markets'][$key]['href']);
            self::assertEquals($market->short, $data['markets'][$key]['short']);
            $response->assertJsonFragment([
                'name' => $data['markets'][$key]['name'],
                'href' => $data['markets'][$key]['href'],
                'short' => $data['markets'][$key]['short']
            ]);
        }
    }

    /**
     * @test
     */
    public function it_shows_admin_on_show_page(): void
    {
        // arrange
        $admins = $this->setUsers();
        $admin = $admins->first();

        // act
        $response = $this->get(route('admins.show', $admin->id));
        $data = $response->viewData('admin');

        // assert
        $response->assertSuccessful();
        $response->assertViewIs('admin.admins.show');
        $response->assertViewHas('admin');
        self::assertEquals($admin->name, $data->name);
        self::assertEquals($admin->email, $data->email);
        self::assertEquals($admin->role_name, $data->role_name);
        foreach ($admin->mainMarkets as $market) {
            self::assertEquals($market->name, $data->name);
        }
    }

    /**
     * @test
     */
    public function it_fails_to_show_admin_on_show_page_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->get(route('admins.show', 1));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_fails_to_show_admins_on_index_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->get(route('admins.index'));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_shows_admin_on_edit_page(): void
    {
        // arrange
        $admins = $this->setUsers();
        $admin = $admins->first();

        // act
        $response = $this->get(route('admins.edit', $admin->id));
        $data = $response->viewData('admin');

        // assert
        $response->assertSuccessful();
        $response->assertViewIs('admin.admins.edit');
        $response->assertViewHas('admin');
        self::assertEquals($admin->name, $data->name);
        self::assertEquals($admin->email, $data->email);
        self::assertEquals($admin->role_name, $data->role_name);
        foreach ($admin->mainMarkets as $market) {
            self::assertEquals($market->name, $data->name);
        }
        self::assertEquals($admin->password, $data->password);
    }

    /**
     * @test
     */
    public function it_fails_to_show_edit_page_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->get(route('admins.edit', 1));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_shows_create_page(): void
    {
        // arrange
        $this->setMarkets();

        // act
        $response = $this->get(route('admins.create'));
        $dataMarkets = $response->viewData('markets');

        // assert
        $response->assertSuccessful();
        $response->assertViewIs('admin.admins.create');
        $response->assertViewHasAll(['markets']);
        foreach ($dataMarkets as $key => $market) {
            self::assertEquals($market->value, $dataMarkets[$key]->value);
        }
    }

    /**
     * @test
     */
    public function it_fails_to_show_create_page_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->get(route('admins.create'));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_creates_admin(): void
    {
        // arrange
        $markets = $this->setMarkets(4)->random(1)->pluck('id')->toArray();

        $data = [
            'name' => 'Admin',
            'role_id' => 1,
            'main_market_id' => $markets,
            'email' => 'admin@admin.com',
            'password' => 'user_password',
            'password_confirmation' => 'user_password',
            'status' => 1
        ];
        $expectedData = [
            'name' => $data['name'],
            'role_id' => $data['role_id'],
            'email' => $data['email'],
            'status' => $data['status']
        ];

        // act
        $response = $this->post(route('admins.store'), $data);
        // assert
        $response->assertRedirect(route('admins.show', 2));
        $this->assertDatabaseHas('users', $expectedData);
        foreach ($markets as $market) {
            $this->assertDatabaseHas(
                'main_market_user',
                ['main_market_id' => $market, 'user_id' => 2]
            );
        }
    }

    /**
     * @test
     */
    public function it_fails_to_create_admin_no_required_fields(): void
    {
        // arrange
        $data = [];

        // act
        $response = $this->post(route('admins.store'), $data);

        // assert
        $response->assertSessionHasErrors(['name', 'email', 'password', 'role_id']);
    }

    /**
     * @test
     */
    public function it_fails_to_create_admin_no_authorization(): void
    {
        // arrange
        Auth::logout();

        // act
        $response = $this->post(route('admins.store'), []);

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_updates_admin(): void
    {
        // arrange
        $admins = $this->setUsers();
        $admin = $admins->first();
        $markets = $this->setMarkets(4)->random(1)->pluck('id')->toArray();

        $data = [
            'name' => 'Admin',
            'role_id' => 1,
            'main_market_id' => $markets,
            'email' => 'admin@admin.com',
            'password' => 'user_password',
            'password_confirmation' => 'user_password',
            'status' => 1
        ];
        $expectedData = [
            'id' => $admin->id,
            'name' => $data['name'],
            'email' => $data['email'],
            'status' => $data['status'],
        ];
        // act
        $response = $this->put(route('admins.update', $admin->id), $data);

        // assert
        $response->assertRedirect(route('admins.show', $admin->id));
        $this->assertDatabaseHas('users', $expectedData);
        foreach ($markets as $market) {
            $this->assertDatabaseHas(
                'main_market_user',
                ['main_market_id' => $market, 'user_id' => 2]
            );
        }
    }

    /**
     * @test
     */
    public function it_fails_to_update_admin_no_required_fields(): void
    {
        // arrange
        $admins = $this->setUsers();
        $admin = $admins->first();
        $data = [];

        // act
        $response = $this->put(route('admins.update', $admin->id), $data);

        // assert
        $response->assertSessionHasErrors(['name', 'email', 'role_id']);
    }

    /**
     * @test
     */
    public function it_fails_to_update_admin_no_authorization(): void
    {
        // arrange
        Auth::logout();

        // act
        $response = $this->put(route('admins.update', 1), []);

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_can_not_delete_admin_if_admin_is_login(): void
    {
        // arrange
        $autUser = Auth::user();

        // act
        $response = $this->delete(route('admins.destroy', $autUser['id']));

        // assert
        $this->assertDatabaseHas('users', ['id' => $autUser['id']]);
    }

    /**
     * @test
     */
    public function it_deletes_admin(): void
    {
        // arrange
        $admins = $this->setUsers(3);
        $admin = $admins->first();

        // act
        $response = $this->delete(route('admins.destroy', $admin->id));

        // assert
        $this->assertDatabaseMissing('users', ['id' => $admin->id]);
        $response->assertRedirect(route('admins.index'));
    }

    /**
     * @test
     */
    public function it_fails_to_delete_admin_no_authorization(): void
    {
        // arrange
        Auth::logout();

        // act
        $response = $this->delete(route('admins.destroy', 1));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @param int $count
     * @return Collection
     */
    public function setUsers($count = 1): Collection
    {
        $this->setMarkets(1);
        return User::factory()->roleMicroAdmin()->count($count)->create();
    }

    /**
     * @param int $count
     * @return Collection
     */
    public function setMarkets($count = 1): Collection
    {
        MainMarketFactory::resetPosition();
        return MainMarket::factory()->count($count)->create();
    }
}
