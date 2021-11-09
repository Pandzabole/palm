<?php

namespace Database\Seeders\Content;

use App\Models\StaticComponent;
use App\Traits\SeedContainable;
use Illuminate\Database\Seeder;

class StaticComponentsProductSeeder extends Seeder
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
        $media = [
            7 => StaticComponent::class,
            9 => StaticComponent::class,
            10 => StaticComponent::class,
            11 => StaticComponent::class,
            12 => StaticComponent::class,
        ];

        $this->seedStaticData($currentSchema, 3, $media);
    }

    /**
     * @return array
     */
    protected function getEnData(): array
    {
        return [
            [
                'tag' => null,
                'primary_title' => '',
                'secondary_title' => null,
                'sub_title' => null,
                'description' => null,
                'cta' => null,
                'url' => null,
                'cta_type' => 'internal',
                'type' => 'staticComponent',
                'config' => [
                    'image' => [
                        'desktop' => [
                            'required' => true,
                            'recommended' => '540x740'
                        ],
                        'mobile' => [
                            'required' => true,
                            'recommended' => '675x925'
                        ]
                    ]
                ],
                'position' => 1,
                'created_at' => now(),
            ],
            [
                'tag' => null,
                'primary_title' => 'Unique Quality - ',
                'secondary_title' => 'Unique Design',
                'sub_title' => null,
                'description' => 'High-quality water deserves a high-quality packaging design. In addition, a square-shaped bottle takes up less space than a standard oval one. This means that more bottle are distributed with less energy use, which leads to grater care for the environment',
                'cta' => null,
                'url' => null,
                'cta_type' => 'internal',
                'slug' => null,
                'type' => 'staticComponent',
                'position' => 2,
                'created_at' => now(),
            ],
            [
                'tag' => null,
                'primary_title' => 'One water',
                'secondary_title' => 'for every Occasion',
                'sub_title' => null,
                'description' => 'As the only artesian naturally filtered water that comes from Serbia, our VODAVODA is recommended daily and in unlimited quantities. "That is why we wanted to offer it to our consumers in various shapes and sizes that can respond to our theirs every need". Whether they are in the office, car, gym, or at home with family nad friends, VODAVODA has the appropriate PET packaging for rehydration and revitalization in every opportunity',
                'cta' => null,
                'url' => null,
                'cta_type' => 'internal',
                'slug' => null,
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
                'position' => 3,
                'created_at' => now(),
            ],
            [
                'tag' => null,
                'primary_title' => 'Glass bottles -',
                'secondary_title' => 'Protecting the nature and perfect mineral balance',
                'sub_title' => null,
                'description' => 'When we talk about "the beauty in harmony with nature" the first association is our iconic glass packaging. It preserves its exterior and interior - the environment and the ideal composition of minerals and electrolytes of our artesian VODAVADA. Also, our glass packaging brings a touch of luxury and elegance to every table, whether it is an office meeting, dinner at home at a restaurant, or cafe.',
                'cta' => null,
                'url' => null,
                'cta_type' => 'internal',
                'slug' => null,
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
                'position' => 4,
                'created_at' => now(),
            ],
            [
                'tag' => null,
                'primary_title' => 'Open',
                'secondary_title' => 'the innovation cap',
                'sub_title' => null,
                'description' => 'Our new line of bottles with a sports cap is an innovation from VODAVODA, inspired by the needs of our most active consumers. “On the one hand, this specially designed cap enables easy water intake, while on the other, it guarantees the preservation of a perfect mineral balance, without ventilation and spillage" Our sports cap series is ideal for all people on the run, as it provides quick and easy rehydration in every situation.',
                'cta' => null,
                'url' => null,
                'cta_type' => 'internal',
                'slug' => null,
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
                'position' => 5,
                'created_at' => now(),
            ],
            [
                'tag' => null,
                'primary_title' => 'Stigla je nova',
                'secondary_title' => 'VODAVODA Vodica',
                'sub_title' => null,
                'description' => 'Stigla je VODAVODA Vodica, prirodno mineralna negazirana voda, posebno prilagođena dečjim potrebama. Naša vodica izvire sa dubine od 605 metara i prirodno se filtrira prolazeći kroz stene i slojeve krečnjaka  iz netaknute prirode, što je čini jednom od najkvalitetnijih arteških voda na svetu. Zbog toga ima idealan sastav minerala za svaku pustolovinu i avanturicu vaših mališana.',
                'cta' => 'Saznaj više na',
                'url' => 'https://www.vodavoda.com/vodavodavodica/',
                'cta_type' => 'external',
                'slug' => null,
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
                'position' => 6,
                'created_at' => now(),
            ],
        ];
    }

    /**
     * @return array
     */
    protected function getArData(): array
    {
        return $this->getEnData();
    }
}
