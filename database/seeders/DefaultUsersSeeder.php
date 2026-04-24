<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultUsersSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name'     => 'Admin',
                'email'    => 'admin@brancoffee.com',
                'password' => Hash::make('password'),
                'role'     => 'admin',
            ],
            [
                'name'     => 'Manager',
                'email'    => 'manager@brancoffee.com',
                'password' => Hash::make('password'),
                'role'     => 'manager',
            ],
            [
                'name'     => 'CS Staff',
                'email'    => 'cs@brancoffee.com',
                'password' => Hash::make('password'),
                'role'     => 'cs',
            ],
            [
                'name'     => 'Member Test',
                'email'    => 'member@brancoffee.com',
                'password' => Hash::make('password'),
                'role'     => 'user',
            ],
        ];

        foreach ($users as $userData) {
            User::updateOrCreate(
                ['email' => $userData['email']],
                $userData
            );
            $this->command->info('Upserted: ' . $userData['email']);
        }
    }
}
