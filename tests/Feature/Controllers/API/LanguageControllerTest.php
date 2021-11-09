<?php

namespace Feature\Controllers\API;

use Tests\ContentTestCase;

class LanguageControllerTest extends ContentTestCase
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

    /** @test */
    public function it_returns_languages(): void
    {
        // arrange
        $dataStructure = [['name', 'native_name', 'short']];

        // act
        $response = $this->json('get', 'api/languages');

        // assert
        $response->assertSuccessful();
        $response->assertJsonStructure($dataStructure);
    }
}
