<?php

namespace Database\Seeders\Content;

use App\Models\StaticComponent;
use App\Traits\SeedContainable;
use Illuminate\Database\Seeder;

class StaticComponentsOurWaterSeeder extends Seeder
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
            13 => StaticComponent::class,
            15 => StaticComponent::class,
            17 => StaticComponent::class,
        ];

        $this->seedStaticData($currentSchema, 2, $media);
    }

    /**
     * @return array
     */
    protected function getEnData(): array
    {
        return [
            [
                'tag' => null,
                'primary_title' => 'Lepota',
                'secondary_title' => null,
                'sub_title' => null,
                'description' => 'High-quality water deserves a high-quality packaging design. In addition, a square-shaped bottle takes up',
                'cta' => null,
                'url' => null,
                'cta_type' => 'internal',
                'type' => 'staticComponent',
                'config' => [
                    'image' => [
                        'desktop' => [
                            'required' => false,
                            'recommended' => '540x740'
                        ],
                        'mobile' => [
                            'required' => false,
                            'recommended' => '430x590'
                        ]
                    ]
                ],
                'position' => 1,
                'created_at' => now(),
            ],
            [
                'tag' => null,
                'primary_title' => 'Harmonija',
                'secondary_title' => null,
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
                'primary_title' => 'VODAVODA',
                'secondary_title' => 'i zdravlje',
                'sub_title' => 'Osobine',
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
                            'recommended' => '525x500'
                        ],
                        'mobile' => [
                            'required' => false,
                            'recommended' => '525x500'
                        ]
                    ]
                ],
                'position' => 3,
                'created_at' => now(),
            ],
            [
                'tag' => null,
                'primary_title' => 'Priroda',
                'secondary_title' => null,
                'sub_title' => null,
                'description' => 'High-quality water deserves a high-quality packaging design. In addition, a square-shaped bottle takes up less space than a standard oval one. This means that more bottle are distributed with less energy use, which leads to grater care for the environment',
                'cta' => null,
                'url' => null,
                'cta_type' => 'internal',
                'slug' => null,
                'type' => 'staticComponent',
                'position' => 4,
                'created_at' => now(),
            ],
            [
                'tag' => null,
                'primary_title' => 'Istorija',
                'secondary_title' => 'i legende',
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
                            'recommended' => '255x330'
                        ],
                        'mobile' => [
                            'required' => false,
                            'recommended' => '300x620'
                        ]
                    ]
                ],
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
        return $this->getEnData();
    }
}
