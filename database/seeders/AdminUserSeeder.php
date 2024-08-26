<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Administrador',
                'email' => 'admin@adm.com',
                'password' => bcrypt('123123123'),
            ],
            [
                'name' => 'Usuario',
                'email' => 'User@user.com',
                'password' => bcrypt('123123123'),
            ],
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }
    }
}
