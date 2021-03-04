<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'user_id'        => 'DRC-D001',
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'address'        => 'sample address',
                'number'         => '09293260792',
                'daily_rate'     => '537.00',
                'password'       => bcrypt('password'),
                'remember_token' => null,
            ],
            [
                'id'             => 2,
                'user_id'        => 'DRC-D002',
                'name'           => 'User',
                'email'          => 'user@user.com',
                'address'        => 'sample address',
                'number'         => '09293260792',
                'daily_rate'     => '537.00',
                'password'       => bcrypt('password'),
                'remember_token' => null,
            ],
        ];

        User::insert($users);
    }
}
