<?php

namespace Database\Seeders\Content;

use Illuminate\Database\Seeder;
use App\Models\Contact;
use App\Traits\SeedContainable;

class ContactSeeder extends Seeder
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
        Contact::factory()->count(15)->create();
    }

    /**
     * @return void
     */
    protected function getArData(): void
    {
        $this->getEnData();
    }
}
