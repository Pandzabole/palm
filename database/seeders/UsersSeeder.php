<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $users = [
            [
                'email' => config('auth.admin.email'),
                'name' => config('auth.admin.name'),
                'password' => bcrypt('password'),
                'status' => 1,
                'role_id' => User::MAIN_ADMIN,
            ],
            [
                'email' => 'english@admin.com',
                'name' => 'English Admin',
                'password' => bcrypt('password'),
                'status' => 1,
                'role_id' => User::MICRO_ADMIN,
            ],
            [
                'email' => 'arabic@admin.com',
                'name' => 'Arabic Admin',
                'password' => bcrypt('password'),
                'status' => 1,
                'role_id' => User::MICRO_ADMIN,
            ]
        ];

        User::insert($users);

    }
}
