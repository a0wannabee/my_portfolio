<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class RandomProjectSeeder extends Seeder
{
    /**
     * Isi 25 project dengan judul acak lewat ProjectFactory.
     */
    public function run(): void
    {
        Project::factory()->count(25)->create();
    }
}
