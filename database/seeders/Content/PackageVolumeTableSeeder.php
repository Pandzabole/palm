<?php

namespace Database\Seeders\Content;

use Illuminate\Database\Seeder;
use App\Models\PackageVolume;
use App\Traits\SeedContainable;

class PackageVolumeTableSeeder extends Seeder
{
    use SeedContainable;

    /** @var string $modelClass */
    private $modelClass = PackageVolume::class;

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
                'value' => '0.33',
                'created_at' => now(),
            ],
            [
                'value' => '0.5',
                'created_at' => now(),
            ],
            [
                'value' => '0.75',
                'created_at' => now(),
            ],
            [
                'value' => '1.0',
                'created_at' => now(),
            ],
            [
                'value' => '1.5',
                'created_at' => now(),
            ]
        ];
    }

    /**
     * Get english pages.
     * @return array
     */
    protected function getArData(): array
    {
        return [
            [
                'value' => '0.33',
                'created_at' => now(),
            ],
            [
                'value' => '0.5',
                'created_at' => now(),
            ],
            [
                'value' => '0.75',
                'created_at' => now(),
            ],
            [
                'value' => '1.0',
                'created_at' => now(),
            ],
            [
                'value' => '1.5',
                'created_at' => now(),
            ]
        ];
    }

    /**
     * Get english pages.
     * @return array
     */
    protected function getOmData(): array
    {
        return [
            [
                'value' => '0.33',
                'created_at' => now(),
            ],
            [
                'value' => '0.5',
                'created_at' => now(),
            ],
            [
                'value' => '0.75',
                'created_at' => now(),
            ],
            [
                'value' => '1.0',
                'created_at' => now(),
            ],
            [
                'value' => '1.5',
                'created_at' => now(),
            ]
        ];
    }
}
