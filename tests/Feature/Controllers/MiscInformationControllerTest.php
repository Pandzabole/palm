<?php

namespace Feature\Controllers;

use App\Models\MiscInformation;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Tests\ContentTestCase;
use Illuminate\Support\Collection;

class MiscInformationControllerTest extends ContentTestCase
{
    /**
     * @test
     */
    public function it_displays_misc_information_view_on_index_page(): void
    {
        // act
        $response = $this->get(route('misc-information.index'));

        // assert
        $response->assertSuccessful();
        $response->assertViewIs('admin.misc-information.index');
    }

    /**
     * @test
     */
    public function it_shows_misc_information_data_on_index(): void
    {
        // arrange
        $miscInformation = $this->seedMiscInformation();

        // act
        $response = $this->json('get', route('misc-information.data'));
        $data = $response->getData()->data;

        // assert
        $response->assertSuccessful();
        foreach ($miscInformation as $key => $information) {
            self::assertEquals($information->name, $data[$key]->name);
            self::assertEquals($information->value, $data[$key]->value);
        }
    }

    /**
     * @test
     */
    public function it_can_not_display_misc_information_on_index_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->get(route('misc-information.index'));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_shows_misc_information_on_edit_page(): void
    {
        // arrange
        $information = $this->seedMiscInformation(3);
        $information = $information->first();

        // act
        $response = $this->get(route('misc-information.edit', $information->id));
        $data = $response->viewData('miscInformation');

        // assert
        $response->assertSuccessful();
        $response->assertViewIs('admin.misc-information.edit');
        self::assertEquals($information->name, $data->name);
        self::assertEquals($information->value, $data->value);
    }

    /**
     * @test
     */
    public function it_can_not_displays_misc_information_on_edit_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->get(route('misc-information.edit', 1));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_updates_misc_information(): void
    {
        // arrange
        $miscInformation = $this->seedMiscInformation();
        $miscInformation = $miscInformation->first();
        $data = [
            'name' => 'Name',
            'value' => 'Value'
        ];
        
        // act
        $this->put(route('misc-information.update', $miscInformation->id), $data);

        // assert
        $this->assertDatabaseHas('misc_information', $data);
    }

    /**
     * @test
     */
    public function it_can_not_update_misc_information_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->put(route('misc-information.update', 1));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_can_not_create_new_misc_information_route_no_exists(): void
    {
        // act
        $this->expectException(RouteNotFoundException::class);
        $this->get(route('misc-information.create'));
    }

    /**
     * @test
     */
    public function it_can_not_delete_misc_information_route_no_exists(): void
    {
        // act
        $this->expectException(RouteNotFoundException::class);
        $this->get(route('misc-information.destroy'));
    }

    /**
     * It create misc information items
     *
     * @param int $count
     * @return Collection
     */
    private function seedMiscInformation(int $count = 1): Collection
    {
        return MiscInformation::factory()->count($count)->create();
    }
}
