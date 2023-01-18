<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@vshouz.ru',
            'password' => Hash::make('123456'),
        ]);

        User::factory()->create([
            'name' => 'man01',
            'email' => 'man01@vshouz.ru',
            'password' => Hash::make('123456'),
        ]);

        User::factory()->create([
            'name' => 'user',
            'email' => 'user@vshouz.ru',
            'password' => Hash::make('123456'),
        ]);

        User::factory()->create([
            'name' => 'expert01',
            'email' => 'expert01@vshouz.ru',
            'password' => Hash::make('123456'),
        ]);
    }
}
