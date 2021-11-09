<?php

namespace Feature\Controllers\API;

use App\Models\ActivityCategory;
use Tests\ContentTestCase;

class ActivityCategoriesControllerTest extends ContentTestCase
{
    /**
     * @test
     * @return void
     */
    public function it_returns_activity_categories(): void
    {
        // arrange
        $activityCategories = ActivityCategory::factory()->count(5)->create();
        $dataToAssert = $activityCategories->transform(
            static function ($activityCategory) {
                return [
                    'name' => $activityCategory->name,
                    'slug' => $activityCategory->slug,
                ];
            }
        )->toArray();

        // act
        $response = $this->getApiJsonResponse('activities/categories');

        // assert
        $response->assertSuccessful();
        self::assertEquals($dataToAssert, $response->getData(true));
    }
}
