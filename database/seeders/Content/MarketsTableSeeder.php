<?php

namespace Database\Seeders\Content;

use App\Models\Market;
use App\Traits\SeedContainable;
use Illuminate\Database\Seeder;

class MarketsTableSeeder extends Seeder
{
    use SeedContainable;

    /** @var string $modelClass */
    private $modelClass = Market::class;

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
                'name' => 'English',
                'href' => '/kw',
                'position' => 1,
                'created_at' => now(),
            ],
            [
                'name' => 'Arabic',
                'href' => '/ar',
                'position' => 2,
                'created_at' => now(),
            ],
        ];
    }

    /**
     * Get serbian pages.
     * @return array
     */
    protected function getArData(): array
    {
        return [
            [
                'name' => 'English',
                'href' => '/en',
                'position' => 1,
                'created_at' => now(),
            ],
            [
                'name' => 'Arabic',
                'href' => '/ar',
                'position' => 2,
                'created_at' => now(),
            ]
        ];
    }
}
