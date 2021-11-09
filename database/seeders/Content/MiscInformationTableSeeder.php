<?php

namespace Database\Seeders\Content;

use App\Models\MiscInformation;
use App\Traits\SeedContainable;
use Illuminate\Database\Seeder;

class MiscInformationTableSeeder extends Seeder
{
    use SeedContainable;

    /** @var string $modelClass */
    private $modelClass = MiscInformation::class;

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
     *
     * @return array
     */
    protected function getEnData(): array
    {
        return [
            [
                'name' => 'Vincent Van Gogh',
                'slug' => 'quote',
                'type' => 'long-text',
                'value' => 'If you truly love nature, you will find beauty everywhere.',
                'created_at' => now(),
            ],
            [
                'name' => 'Facebook',
                'slug' => 'facebook',
                'type' => 'external-link',
                'value' => 'https://www.facebook.com/',
                'created_at' => now(),
            ],
            [
                'name' => 'Instagram',
                'slug' => 'instagram',
                'type' => 'external-link',
                'value' => 'https://www.instagram.com/',
                'created_at' => now(),
            ],
            [
                'name' => 'Youtube',
                'slug' => 'youtube',
                'type' => 'external-link',
                'value' => 'https://www.youtube.com/',
                'created_at' => now(),
            ],
            [
                'name' => 'Call center',
                'slug' => 'call-center',
                'type' => 'phone',
                'value' => '011 25 80 100',
                'created_at' => now(),
            ],
            [
                'name' => 'Email',
                'slug' => 'email',
                'type' => 'email',
                'value' => 'marketing@vodavoda.com',
                'created_at' => now(),
            ],
            [
                'name' => 'Address',
                'slug' => 'address',
                'type' => 'address',
                'value' => 'Gornja Toplica BB, Banja Vrujci, Srbija',
                'created_at' => now(),
            ],
        ];
    }

    /**
     * Get kuwait pages.
     *
     * @return array
     */
    protected function getArData(): array
    {
        return [
            [
                'name' => 'Vincent Van Gogh',
                'slug' => 'quote',
                'type' => 'long-text',
                'value' => 'إذا كنت تحب الطبيعة حقًا ، ستجد الجمال في كل مكان.',
                'created_at' => now(),
            ],
            [
                'name' => 'Facebook',
                'slug' => 'facebook',
                'type' => 'external-link',
                'value' => 'https://www.facebook.com/',
                'created_at' => now(),
            ],
            [
                'name' => 'Instagram',
                'slug' => 'instagram',
                'type' => 'external-link',
                'value' => 'https://www.instagram.com/',
                'created_at' => now(),
            ],
            [
                'name' => 'Youtube',
                'slug' => 'youtube',
                'type' => 'external-link',
                'value' => 'https://www.youtube.com/',
                'created_at' => now(),
            ],
            [
                'name' => 'مركز الاتصال',
                'slug' => 'call-center',
                'type' => 'phone',
                'value' => '011 25 80 100',
                'created_at' => now(),
            ],
            [
                'name' => 'بريد الالكتروني',
                'slug' => 'email',
                'type' => 'email',
                'value' => 'marketing@vodavoda.com',
                'created_at' => now(),
            ],
            [
                'name' => 'تبوك',
                'slug' => 'address',
                'type' => 'address',
                'value' => 'Gornja Toplica BB, Banja Vrujci, Srbija',
                'created_at' => now(),
            ],
        ];
    }
}
