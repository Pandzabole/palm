<?php

use App\Models\Content\ImageContent;
use App\Models\Content\RichTextContent;
use App\Models\Content\TextContent;
use App\Models\Content\VideoContent;

return [
    'types' => [
        'rich_text' => RichTextContent::class,
        'text' => TextContent::class,
        'image' => ImageContent::class,
        'video' => VideoContent::class
    ],
    'text_types' => ['p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6']
];
