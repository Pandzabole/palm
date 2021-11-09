<?php

namespace Feature\Controllers;

use App\Models\Market;
use Database\Factories\MarketFactory;
use Illuminate\Support\Collection;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Tests\ContentTestCase;

class MarketControllerTest extends ContentTestCase
{
    /**
     * @test
     */
    public function it_displays_markets_view_on_index_page(): void
    {
        // act
        $response = $this->get(route('markets.index'));

        // assert
        $response->assertSuccessful();
        $response->assertViewIs('admin.markets.index');
    }

    /**
     * @test
     */
    public function it_shows_markets_data_on_index(): void
    {
        // arrange
        $markets = $this->seedMarkets();

        // act
        $response = $this->json('get', route('markets.data'));
        $data = $response->getData()->data;

        // assert
        $response->assertSuccessful();
        foreach ($markets as $key => $market) {
            self::assertEquals($market->name, $data[$key]->name);
        }
    }

    /**
     * @test
     */
    public function it_can_not_display_markets_on_index_page_if_user_is_not_logged_in(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->get(route('markets.index'));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_displays_markets_data_on_show_page(): void
    {
        // arrange
        $markets = $this->seedMarkets(5);
        $market = $markets->first();

        // act
        $response = $this->get(route('markets.show', $market->id));
        $data = $response->viewData('market');

        // assert
        $response->assertSuccessful();
        $response->assertViewIs('admin.markets.show');

        self::assertEquals($market->toArray(), $data->toArray());
    }

    /**
     * @test
     */
    public function it_can_not_display_market_on_show_page_if_user_is_not_logged_in(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->get(route('markets.show', 1));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_can_not_displays_non_existing_market_on_show_page(): void
    {
        // act
        $response = $this->get(route('markets.show', 200));

        // assert
        $response->assertStatus(404);
    }

    /**
     * @test
     */
    public function it_shows_market_on_edit_page(): void
    {
        // arrange
        $markets = $this->seedMarkets(3);
        $market = $markets->first();

        // act
        $response = $this->get(route('markets.edit', $market->id));
        $data = $response->viewData('market');

        // assert
        $response->assertSuccessful();
        $response->assertViewIs('admin.markets.edit');
        self::assertEquals($market->name, $data->name);
    }

    /**
     * @test
     */
    public function it_fails_to_show_edit_page_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->get(route('markets.edit', 1));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_updates_required_fields_for_market(): void
    {
        // arrange
        $markets = $this->seedMarkets();
        $market = $markets->first();
        $data = [
            'name' => 'Test Name',
        ];

        // act
        $response = $this->put(route('markets.update', $market->id), $data);

        // assert
        $this->assertDatabaseHas('markets', ['name' => $data['name']]);
    }

    /**
     * @test
     */
    public function it_fails_to_update_market_data_no_required_fields(): void
    {
        // arrange
        $markets = $this->seedMarkets();
        $market = $markets->first();
        $data = [
            'name' => '',
        ];

        // act
        $response = $this->put(route('markets.update', $market->id), $data);

        // assert
        $response->assertSessionHasErrors(['name']);
    }

    /**
     * @test
     */
    public function it_can_not_update_markets_if_user_is_not_logged_in(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->get(route('markets.update', 1));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_can_not_create_new_market_route_no_exists(): void
    {
        // act
        $this->expectException(RouteNotFoundException::class);
        $this->get(route('markets.create'));
    }

    /**
     * @test
     */
    public function it_can_not_delete_market_route_no_exists(): void
    {
        // act
        $this->expectException(RouteNotFoundException::class);
        $this->get(route('markets.destroy'));
    }

    /**
     * @test
     */
    public function it_reorders_markets(): void
    {
        // arrange
        $this->seedMarkets(2);

        $data = ['items' => [['new' => 1, 'old' => 2], ['new' => 2, 'old' => 1]]];
        $expectedData = [
            ['id' => 1, 'position' => 2],
            ['id' => 2, 'position' => 1]
        ];

        // arrange
        $this->post(route('markets.reorder'), $data);

        // assert
        $this->assertDatabaseHas('markets', $expectedData[0]);
        $this->assertDatabaseHas('markets', $expectedData[1]);
    }

    /**
     * @test
     */
    public function it_fails_to_reorder_markets_no_required_sort_order(): void
    {
        // arrange
        $this->seedMarkets(2);
        $data = ['items' => [['new' => 99, 'old' => 98], ['new' => 97, 'old' => 98]]];

        // arrange
        $response = $this->post(route('markets.reorder'), $data);

        // assert
        $response->assertSessionHasErrors(['items.0.new', 'items.1.new', 'items.0.old', 'items.1.old']);
    }

    /**
     * It create markets items
     *
     * @param int $count
     * @return Collection
     */
    private function seedMarkets(int $count = 1): Collection
    {
        MarketFactory::resetPosition();

        return Market::factory()->count($count)->create();
    }
}
