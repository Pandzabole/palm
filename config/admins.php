<?php

use App\Models\User;

return [
    'admins' => [
        User::MICRO_ADMIN => 'Micro admin',
        User::ADMIN => 'Site admin',
        User::MAIN_ADMIN => 'Super admin',
    ]
];
