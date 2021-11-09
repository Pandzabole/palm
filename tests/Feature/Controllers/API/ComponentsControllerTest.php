<?php

namespace Feature\Controllers\API;

use App\Models\Page;
use App\Models\StaticComponent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Tests\ContentTestCase;

class ComponentsControllerTest extends ContentTestCase
{
    /**
     * @test
     */
    public function it_returns_component_types(): void
    {
        // arrange
        $data = ['types' => array_keys(config('relationships.page'))];

        // act
        $response = $this->getApiJsonResponse('components/types');

        // assert
        $response->assertSuccessful();
        self::assertEquals($data, $response->getData(true));
    }

    /**
     * @test
     */
    public function it_returns_all_components(): void
    {
        // arrange
        $pageComponents = $this->setComponents();
        $page = $pageComponents->first();
        $data = $this->preparePage($page);

        // act
        $response = $this->getApiJsonResponse('components/' . $page->slug);

        // assert
        $response->assertSuccessful();
        self::assertEquals($data, $response->getData(true));
    }

    /**
     * @param $count
     * @return Collection|Model|mixed
     */
    private function setComponents($count = 1)
    {
        return Page::factory()
            ->count($count)
            ->has(StaticComponent::factory())
            ->has(StaticComponent::factory()->type('news'))
            ->has(StaticComponent::factory()->type('slider'))
            ->has(StaticComponent::factory()->type('activity'))
            ->create();
    }

    /**
     * @param Page $page
     * @return array
     */
    private function preparePage(Page $page): array
    {
        return [
            'page' => [
                'name' => $page->name,
                'slug' => $page->slug,
                'href' => $page->href,
            ],
            'components' => $this->prepareComponents($page)
        ];
    }

    /**
     * @param Page $page
     * @return array
     */
    private function prepareComponents(Page $page): array
    {
        $components = $page->staticComponent->merge(
            $page->news->merge($page->activity)
        )->sortBy('position');

        return $components->transform(
            function ($component) {
                return [
                    'type' => $component->type,
                    'tag' => $component->tag,
                    'slug' => $component->slug,
                    'position' => $component->position,
                    'description' => $component->description,
                    'title' => [
                        'primary' => $component->primary_title,
                        'secondary' => $component->secondary_title,
                        'sub_title' => $component->sub_title,
                    ],
                    'cta' => [
                        'text' => $component->cta,
                        'url' => $component->url,
                        'url_type' => $component->cta_type
                    ],
                    'content' => [
                        "image" => [
                            "desktop" => [
                                "image_url" => null,
                                "base64" => null
                            ],
                            "mobile" => [
                                "image_url" => null,
                                "base64" => null,
                            ]
                        ]
                    ]
                ];
            }
        )->toArray();
    }
}
