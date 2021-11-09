<?php

namespace Database\Seeders\Content;

use App\Models\Media;
use App\Models\Product;
use App\Traits\SeedContainable;
use Database\Factories\ProductFactory;
use Exception;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
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
     * @throws Exception
     */
    public function getEnData(): void
    {
        ProductFactory::resetPosition();
        Product::factory()
            ->count(7)
            ->has(Media::factory()->image('desktop', 'product', false))
            ->has(Media::factory()->image('mobile', 'product', false))
            ->create(
                [
                    'package_number_id' => random_int(1, 2),
                    'package_volume_id' => random_int(1, 5)
                ]
            );
    }

    /**
     * @throws Exception
     */
    public function getArData(): void
    {
        $this->getEnData();
    }
}
