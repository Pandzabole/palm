<?php

namespace Tests\Feature\Controllers\API;

use App\Models\MetaData;
use App\Models\Page;
use Illuminate\Support\Collection;
use Tests\ContentTestCase;

class MetaDataControllerTest extends ContentTestCase
{
    /** @var Collection $pages */
    private $pages;

    /**
     * @test
     * @return void
     */
    public function it_returns_meta_data_by_slug_for_page(): void
    {
        // arrange
        $dataToAssert = $this->prepareMetaDataToAssert(3);
        $page = $this->pages->first();

        // act
        $response = $this->getApiJsonResponse('meta-data/' . $page['slug']);

        // assert
        $response->assertJson($dataToAssert);
        $response->assertSuccessful();
    }

    /**
     * @param int $count
     * @return Collection
     */
    public function seedMetaData(int $count): Collection
    {
        $this->pages = Page::factory()->count($count)->create();

        return MetaData::factory()->count($count)->hasMedia()->create();
    }

    /**
     * @param int $count
     * @return array
     */
    private function prepareMetaDataToAssert($count = 1): array
    {
        $data = $this->seedMetaData($count);
        $pageId = $this->pages->first()->id;
        $data = $data->firstWhere('page_id', $pageId);

        return [
            'title' => $data->title,
            'keywords' => explode(',', $data->keywords),
            'description' => $data->description,
            'image' => $data->firstMediaUrl(),
        ];
    }
}
