<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admingreenkit01@gmail.com'],
            [
                'name' => 'AdminGreenKit01',
                'nama_lengkap' => 'Admin GreenKit',
                'password' => Hash::make('greenkitadmin01'),
                'is_admin' => true,
            ]
        );
    }
}
