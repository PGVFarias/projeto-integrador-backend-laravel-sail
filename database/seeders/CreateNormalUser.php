<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateNormalUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate([
            'name' => 'User',
            'email' => 'user@example.com',
        ], [
            'password' => Hash::make('password')
        ]);
    }
}
