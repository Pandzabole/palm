<?php

namespace Database\Seeders\Content;

use Illuminate\Database\Seeder;
use App\Models\PackageNumber;
use App\Traits\SeedContainable;

class PackageNumberTableSeeder extends Seeder
{
    use SeedContainable;

    /** @var string $modelClass */
    private $modelClass = PackageNumber::class;

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
                'value' => 6,
                'created_at' => now(),
            ],
            [
                'value' => 12,
                'created_at' => now(),
            ]
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
                'value' => 6,
                'created_at' => now(),
            ],
            [
                'value' => 12,
                'created_at' => now(),
            ]
        ];
    }
}
