<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Hazron Furrion',
            'email' => 'admin@furrion.com',
            'role' => 'admin',
            'password' => bcrypt('admin'),
        ]);

        User::create([
            'name' => 'Deki Karya Nurdi',
            'email' => 'deki@gmail.com',
            'role' => 'owner',
            'password' => bcrypt('dekikaryanurdi')
        ]);
    }
}
