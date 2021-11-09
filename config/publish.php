<?php

return [
    'endpoint' => env('PUBLISH_ENDPOINT', 'localhost:3010/publish'),
    'exclude-views' => ['login', 'language', 'password', 'l5-swagger', 'dashboard', 'admins', null]
];
