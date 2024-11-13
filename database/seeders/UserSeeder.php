<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('123456'),
            'role' => 'A', // Administrador
        ]);

        User::create([
            'name' => 'Cliente User',
            'email' => 'cliente@example.com',
            'password' => Hash::make('123456'),
            'role' => 'C', // Cliente
        ]);

        User::create([
            'name' => 'Visitante User',
            'email' => 'visitante@example.com',
            'password' => Hash::make('123456'),
            'role' => 'C', // Cliente
        ]);
    }
}
