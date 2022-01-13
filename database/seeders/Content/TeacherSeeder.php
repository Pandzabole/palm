<?php

namespace Database\Seeders\Content;

use App\Models\Teacher;
use App\Traits\SeedContainable;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    use SeedContainable;

    /** @var string $modelClass */
    private $modelClass = Teacher::class;

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
                'name' => 'Mike Mike',
                'gender_id' => 1,
                'email' => 'mike@emial.com',
                'phone' => 06556235656,
            ],
            [
                'name' => 'Sara Jo',
                'gender_id' => 2,
                'email' => 'sara@emial.com',
                'phone' => 06556235656,
            ],
            [
                'name' => 'Peter Peter',
                'gender_id' => 1,
                'email' => 'peter@emial.com',
                'phone' => 06556235656,
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
                'name' => 'Mike Mike',
                'gender_id' => 1,
                'email' => 'mike@emial.com',
                'phone' => 06556235656,
            ],
            [
                'name' => 'Sara Jo',
                'gender_id' => 2,
                'email' => 'sara@emial.com',
                'phone' => 06556235656,
            ],
            [
                'name' => 'Peter Peter',
                'gender_id' => 1,
                'email' => 'peter@emial.com',
                'phone' => 06556235656,
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
                'name' => 'Mike Mike',
                'gender_id' => 1,
                'email' => 'mike@emial.com',
                'phone' => 06556235656,
            ],
            [
                'name' => 'Sara Jo',
                'gender_id' => 2,
                'email' => 'sara@emial.com',
                'phone' => 06556235656,
            ],
            [
                'name' => 'Peter Peter',
                'gender_id' => 1,
                'email' => 'peter@emial.com',
                'phone' => 06556235656,
            ],
        ];
    }
}
