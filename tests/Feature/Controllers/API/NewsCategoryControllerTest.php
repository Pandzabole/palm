<?php

namespace Feature\Controllers\API;

use App\Models\NewsCategory;
use Tests\ContentTestCase;

class NewsCategoryControllerTest extends ContentTestCase
{
    /**
     * @test
     * @return void
     */
    public function it_returns_news_categories(): void
    {
        // arrange
        $newsCategories = NewsCategory::factory()->count(5)->create();
        $dataToAssert = $newsCategories->transform(
            static function ($newsCategory) {
                return [
                    'name' => $newsCategory->name,
                    'slug' => $newsCategory->slug,
                ];
            }
        )->toArray();

        // act
        $response = $this->getApiJsonResponse('news/categories');

        // assert
        $response->assertSuccessful();
        self::assertEquals($dataToAssert, $response->getData(true));
    }
}
