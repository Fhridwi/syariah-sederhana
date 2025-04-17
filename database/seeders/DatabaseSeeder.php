<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin Sistem',
            'akses' => 'admin',
            'no_hp' => '085792336956',
            'alamat' => null,
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12121212'), 
            'remember_token' => Str::random(10),
        ]);
        
    }
}
