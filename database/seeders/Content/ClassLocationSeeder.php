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
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
            ],
            [
                'location' => 'Online',
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),

            ],
            [
                'location' => 'Outdoors',
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
            ],
            [
                'location' => 'To be discussed',
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
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
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
            ],
            [
                'location' => 'متصل',
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),

            ],
            [
                'location' => 'في الهواء الطلق',
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
            ],
            [
                'location' => 'للنقاش',
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
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
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
            ],
            [
                'location' => 'متصل',
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),

            ],
            [
                'location' => 'في الهواء الطلق',
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
            ],
            [
                'location' => 'للنقاش',
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
            ]
        ];
    }
}
