<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin Perpustakaan',
            'email' => 'admin@perpustakaan.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create regular user
        User::create([
            'name' => 'User Member',    
            'email' => 'user@perpustakaan.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // Run other seeders
        $this->call([
            CategorySeeder::class,
            PublisherSeeder::class,
            BookSeeder::class,
            MemberSeeder::class,
            BorrowingSeeder::class,
        ]);
    }
}
