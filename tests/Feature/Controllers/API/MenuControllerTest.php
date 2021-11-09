<?php

namespace Feature\Controllers\API;

use Tests\ContentTestCase;

class MenuControllerTest extends ContentTestCase
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
     * @return void
     */
    public function it_returns_menu(): void
    {
        // arrange
        $dataStructure = ['menu_items'];

        // act
        $response = $this->json('get', 'api/menu');

        // assert
        $response->assertJsonStructure($dataStructure);
        $response->assertSuccessful();
    }
}
