<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectTableSeeder extends Seeder
{
    /**
     * Isi 20 portofolio contoh.
     */
    public function run(): void
    {
        // Kosongkan tabel dulu agar data tidak dobel saat seeder dijalankan ulang
        Project::truncate();

        for ($i = 1; $i <= 20; $i++) {
            Project::create([
                'title' => 'Portofolio ' . $i,
                'description' => 'Deskripsi untuk portofolio ' . $i,
                'status' => $i % 2 === 0 ? 'published' : 'draft',
            ]);
        }
    }
}
