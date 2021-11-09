<?php

use App\Models\ActivityComponent;
use App\Models\NewsComponent;
use App\Models\Slider;
use App\Models\StaticComponent;

return [
    'page' => [
        'slider' => [
            'class' => Slider::class,
        ],
        'staticComponent' => [
            'class' => StaticComponent::class,
        ],
        'news' => [
            'class' => NewsComponent::class,
        ],
        'activity' => [
            'class' => ActivityComponent::class,
        ]
    ],
];
