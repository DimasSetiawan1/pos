<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Rabil Setiady',
            'username' => 'rabil setiady123',
            'password' => Hash::make('rabil12345'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Kasir Cafe',
            'username' => 'kasir01',
            'password' => Hash::make('kasir123'),
            'role' => 'kasir'
        ]);
    }
}