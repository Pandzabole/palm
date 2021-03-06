<?php

namespace Database\Seeders\Content;

use App\Models\Page;
use App\Traits\SeedContainable;
use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    use SeedContainable;

    /** @var string $modelClass */
    private $modelClass = Page::class;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->seedData();
    }

    /**
     * Get english pages.
     * @return array
     */
    protected function getEnData(): array
    {
        return [
            [
                'name' => 'Home',
                'slug' => 'home',
                'href' => '/',
                'position' => 1,
                'created_at' => now(),
            ],
            [
                'name' => 'Our water',
                'slug' => 'our-water',
                'href' => '/water',
                'position' => 2,
                'created_at' => now(),
            ],
            [
                'name' => 'Products',
                'slug' => 'products',
                'href' => '/products',
                'position' => 3,
                'created_at' => now(),
            ],
            [
                'name' => 'Markets',
                'slug' => 'markets',
                'href' => '/markets',
                'position' => 4,
                'created_at' => now(),
            ],
            [
                'name' => 'News',
                'slug' => 'News',
                'href' => '/news',
                'position' => 5,
                'created_at' => now(),
            ],
            [
                'name' => 'Actual',
                'slug' => 'actual',
                'href' => '/actual',
                'position' => 6,
                'created_at' => now(),
            ],
            [
                'name' => 'Contact',
                'slug' => 'contact',
                'href' => '/contact',
                'position' => 7,
                'created_at' => now(),
            ]
        ];
    }

    /**
     * Get Arabian pages.
     * @return array
     */
    protected function getArData(): array
    {
        return [
            [
                'name' => '???????????? ????????????????',
                'slug' => 'home',
                'href' => '/',
                'position' => 1,
                'created_at' => now(),
            ],
            [
                'name' => '????????????',
                'slug' => 'our-water',
                'href' => '/water',
                'position' => 2,
                'created_at' => now(),
            ],
            [
                'name' => '????????????',
                'slug' => 'products',
                'href' => '/products',
                'position' => 3,
                'created_at' => now(),
            ],
            [
                'name' => '?????????? ????????',
                'slug' => 'markets',
                'href' => '/markets',
                'position' => 4,
                'created_at' => now(),
            ],
            [
                'name' => '??????????',
                'slug' => 'news',
                'href' => '/news',
                'position' => 5,
                'created_at' => now(),
            ],
            [
                'name' => '????????',
                'slug' => 'actual',
                'href' => '/actual',
                'position' => 6,
                'created_at' => now(),
            ],
            [
                'name' => '??????????',
                'slug' => 'contact',
                'href' => '/contact',
                'position' => 7,
                'created_at' => now(),
            ]
        ];
    }

    /**
     * Get Oman pages.
     * @return array
     */
    protected function getOmData(): array
    {
        return [
            [
                'name' => '???????????? ????????????????',
                'slug' => 'home',
                'href' => '/',
                'position' => 1,
                'created_at' => now(),
            ],
            [
                'name' => '????????????',
                'slug' => 'our-water',
                'href' => '/water',
                'position' => 2,
                'created_at' => now(),
            ],
            [
                'name' => '????????????',
                'slug' => 'products',
                'href' => '/products',
                'position' => 3,
                'created_at' => now(),
            ],
            [
                'name' => '?????????? ????????',
                'slug' => 'markets',
                'href' => '/markets',
                'position' => 4,
                'created_at' => now(),
            ],
            [
                'name' => '??????????',
                'slug' => 'news',
                'href' => '/news',
                'position' => 5,
                'created_at' => now(),
            ],
            [
                'name' => '????????',
                'slug' => 'actual',
                'href' => '/actual',
                'position' => 6,
                'created_at' => now(),
            ],
            [
                'name' => '??????????',
                'slug' => 'contact',
                'href' => '/contact',
                'position' => 7,
                'created_at' => now(),
            ]
        ];
    }
}

