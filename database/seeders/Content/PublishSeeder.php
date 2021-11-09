<?php
namespace Database\Seeders\Content;

use App\Models\Publish;
use App\Traits\SeedContainable;
use Illuminate\Database\Seeder;

class PublishSeeder extends Seeder
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
     * @return void|array
     */
    protected function getEnData(): void
    {
        Publish::factory()->create();
    }

    /**
     * @return void|array
     */
    protected function getArData(): void
    {
        Publish::factory()->create();
    }
}
