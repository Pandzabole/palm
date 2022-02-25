<?php

namespace Database\Seeders\Content;

use App\Models\Classe;
use App\Traits\SeedContainable;
use Illuminate\Database\Seeder;

class ClasseSeeder extends Seeder
{
    use SeedContainable;

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
     * @return void
     */
    protected function getEnData(): void
    {
        Classe::factory()
            ->count(2)
            ->create()
            ->each(
                function ($class) {
                    $class->media()->attach([1, 2]);
                }
            );
    }

    /**
     * @return void
     */
    protected function getArData(): void
    {
        $this->getEnData();
    }

    /**
     * @return void
     */
    protected function getOmData(): void
    {
        $this->getEnData();
    }

}
