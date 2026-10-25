<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Cek dulu agar tidak error duplicate email saat db:seed dijalankan dua kali
        if (! User::where('email', 'test@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
        }

        // RandomProjectSeeder (25 data acak via factory) bisa dijalankan terpisah:
        // php artisan db:seed --class=RandomProjectSeeder
        $this->call([
            ProjectTableSeeder::class,
        ]);
    }
}
