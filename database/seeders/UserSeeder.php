<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin DFI',
            'username' => 'admin',
            'email' => 'admin@digitalforte.co.id',
            'password' => Hash::make('admin123')
        ]);
    }
}
