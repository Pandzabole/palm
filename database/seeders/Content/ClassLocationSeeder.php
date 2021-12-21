<?php

namespace Database\Seeders\Content;

use Illuminate\Database\Seeder;
use App\Models\ClassLocation;
use App\Traits\SeedContainable;

class ClassLocationSeeder extends Seeder
{
    use SeedContainable;

    /** @var string $modelClass */
    private $modelClass = ClassLocation::class;

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
     * @return array
     */
    protected function getEnData(): array
    {
        return [
            [
                'location' => 'Home',
            ],
            [
                'location' => 'Online',

            ],
            [
                'location' => 'Outdoors',
            ],
            [
                'location' => 'To be discussed',
            ]
        ];
    }

    /**
     * @return array
     */
    protected function getArData(): array
    {
        return [
            [
                'location' => 'مسكن',
            ],
            [
                'location' => 'متصل',

            ],
            [
                'location' => 'في الهواء الطلق',
            ],
            [
                'location' => 'للنقاش',
            ]
        ];
    }

    /**
     * @return array
     */
    protected function getOmData(): array
    {
        return [
            [
                'location' => 'مسكن',
            ],
            [
                'location' => 'متصل',

            ],
            [
                'location' => 'في الهواء الطلق',
            ],
            [
                'location' => 'للنقاش',
            ]
        ];
    }
}
