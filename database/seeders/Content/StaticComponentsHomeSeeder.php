<?php

namespace Database\Seeders\Content;

use App\Models\StaticComponent;
use App\Traits\SeedContainable;
use Illuminate\Database\Seeder;

class StaticComponentsHomeSeeder extends Seeder
{
    use SeedContainable;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $currentSchema = $this->getCurrentSchema();
        $media = [2 => StaticComponent::class];

        $this->seedStaticData($currentSchema, 1, $media);
    }

    /**
     * @return array
     */
    protected function getEnData(): array
    {
        return [
            [
                'tag' => null,
                'primary_title' => 'Our',
                'secondary_title' => 'Water',
                'sub_title' => 'is the highest quality artesian water in the world',
                'description' => 'Thanks to its well-balanced composition, VODAVODA is a perfect combination of minerals and salt and is ideal for everyday use. Its consumption has a beneficial effect on all cellular processes in the body and is good for all age groups.',
                'cta' => 'our water',
                'url' => '/water',
                'cta_type' => 'internal',
                'slug' => 'our',
                'type' => 'staticComponent',
                'config' => [
                    'image' => [
                        'desktop' => [
                            'required' => false,
                            'recommended' => '540x740'
                        ],
                        'mobile' => [
                            'required' => false,
                            'recommended' => '675x925'
                        ]
                    ]
                ],
                'position' => 1,
                'created_at' => now(),
            ],
            [
                'tag' => null,
                'primary_title' => 'Proud',
                'secondary_title' => 'on our products',
                'sub_title' => null,
                'description' => 'Thanks to its well-balanced composition, VODAVODA is a perfect combination of minerals and salt and is ideal for everyday use',
                'cta' => 'our products',
                'url' => '/products',
                'cta_type' => 'internal',
                'slug' => 'proud',
                'type' => 'staticComponent',
                'position' => 2,
                'created_at' => now(),
            ],
            [
                'tag' => 'We are',
                'primary_title' => 'international',
                'secondary_title' => null,
                'sub_title' => 'vodavoda',
                'description' => 'Thanks to its well-balanced composition, VODAVODA is a perfect combination of minerals and salt and is ideal for everyday use',
                'cta' => 'discover',
                'url' => '/home',
                'cta_type' => 'internal',
                'slug' => 'markets',
                'type' => 'staticComponent',
                'position' => 3,
                'created_at' => now(),
            ],
            [
                'tag' => null,
                'primary_title' => 'News',
                'secondary_title' => null,
                'sub_title' => 'about us',
                'description' => null,
                'cta' => 'See all',
                'url' => '/news',
                'cta_type' => 'internal',
                'slug' => 'news',
                'type' => 'news',
                'position' => 4,
                'created_at' => now(),
            ],
            [
                'tag' => null,
                'primary_title' => 'Actual',
                'secondary_title' => null,
                'sub_title' => 'about us',
                'description' => null,
                'cta' => 'See all',
                'url' => '/actual',
                'cta_type' => 'internal',
                'slug' => 'actual',
                'type' => 'activity',
                'position' => 5,
                'created_at' => now(),
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
                'tag' => null,
                'primary_title' => 'ملكنا',
                'secondary_title' => 'ماء',
                'sub_title' => 'je najkvalitetnija arteška voda na svetu',
                'description' => 'Zahvaljujući dobro izbalansiranom sastavu, VODAVODA je savršenojedinstvo minerala i soli i idealna je za svakodnevno korišćenje. Njena konzumacija povoljno utične na sve ćeliske proceseu organizmu i dobra je za sve starosne grupe',
                'cta' => 'naša voda',
                'url' => '/water',
                'cta_type' => 'internal',
                'slug' => 'naša',
                'type' => 'staticComponent',
                'position' => 1,
                'created_at' => now(),
            ],
            [
                'tag' => null,
                'primary_title' => 'Ponosni',
                'secondary_title' => 'na naše proizvode',
                'sub_title' => null,
                'description' => 'Zahvaljujući dobro izbalansiranom sastavu, VODAVODA je savršenojedinstvo minerala i soli i idealna je za svakodnevno korišćenje',
                'cta' => 'pogledajte naše proizvode',
                'url' => '/products',
                'cta_type' => 'internal',
                'slug' => 'ponosni',
                'type' => 'staticComponent',
                'position' => 2,
                'created_at' => now(),
            ],
            [
                'tag' => 'Mi smo',
                'primary_title' => 'internacionalna',
                'secondary_title' => null,
                'sub_title' => 'vodavoda',
                'description' => 'Zahvaljujući dobro izbalansiranom sastavu, VODAVODA je savršenojedinstvo minerala i soli i idealna je za svakodnevno korišćenje.',
                'cta' => 'otkrij',
                'url' => '/home',
                'cta_type' => 'internal',
                'slug' => 'markets',
                'type' => 'staticComponent',
                'position' => 3,
                'created_at' => now(),
            ],
            [
                'tag' => null,
                'primary_title' => 'O nama',
                'secondary_title' => null,
                'sub_title' => 'na dohvat ruke',
                'description' => null,
                'cta' => 'Pogledaj sve novosti',
                'url' => '/news',
                'cta_type' => 'internal',
                'slug' => 'news',
                'type' => 'news',
                'position' => 4,
                'created_at' => now(),
            ],
            [
                'tag' => null,
                'primary_title' => 'Aktuelnosti',
                'secondary_title' => null,
                'sub_title' => 'u vezi sa nama na dohvat ruke',
                'description' => null,
                'cta' => 'See all',
                'url' => '/actual',
                'cta_type' => 'internal',
                'slug' => 'actual',
                'type' => 'activity',
                'position' => 5,
                'created_at' => now(),
            ]
        ];
    }
}
