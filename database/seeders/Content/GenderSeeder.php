<?php

namespace Database\Seeders\Content;

use Illuminate\Database\Seeder;
use App\Models\Gender;
use App\Traits\SeedContainable;

class GenderSeeder extends Seeder
{
    use SeedContainable;

    /** @var string $modelClass */
    private $modelClass = Gender::class;

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
                'gender' => 'Male',
            ],
            [
                'gender' => 'Female',

            ],
        ];
    }

    /**
     * @return array
     */
    protected function getArData(): array
    {
        return [
            [
                'gender' => 'الذكر',
            ],
            [
                'gender' => 'الجنس أنثى',

            ],
        ];
    }

    /**
     * @return array
     */
    protected function getOmData(): array
    {
        return [
            [
                'gender' => 'الذكر',
            ],
            [
                'gender' => 'الجنس أنثى',
            ],
        ];
    }
}
