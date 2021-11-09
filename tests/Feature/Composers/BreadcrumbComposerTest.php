<?php

namespace Tests\Feature\Composers;

use Tests\ContentTestCase;

class BreadcrumbComposerTest extends ContentTestCase
{
    /**
     * @test
     */
//    public function it_shows_breadcrumb_two_levels_data_with_view(): void
//    {
        // TODO implement on first done resource
        // arrange
//        $name = 'resource';
//        $action = 'list';

        // act
        //$response = $this->get(route('resource.index'));

        // assert
        // $response->assertSuccessful();
        // $response->assertViewHasAll(compact(['action', 'name']));
//    }

    /**
     * @test
     */
    public function it_shows_breadcrumb_one_level_data_with_view(): void
    {
        // arrange
        $action = null;
        $name = 'dashboard';

        // act
        $response = $this->get(route('dashboard'));

        // assert
        $response->assertSuccessful();
        $response->assertViewHasAll(compact('action', 'name'));
    }
}
