<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $jenis = ['Website', 'Aplikasi', 'Sistem Informasi', 'Dashboard'];
        $tema = [
            'Toko Online', 'Perpustakaan', 'Booking Lapangan', 'Manajemen Tugas',
            'Katalog Produk', 'Pencatatan Keuangan', 'Absensi Siswa', 'Reservasi Kafe',
            'Jadwal Kuliah', 'Profil Desa', 'Blog Pribadi', 'Rental Kamera',
        ];

        $judul = fake()->randomElement($jenis) . ' ' . fake()->randomElement($tema);

        return [
            'title' => $judul,
            'description' => 'Dibangun dengan '
                . fake()->randomElement(['Laravel', 'PHP Native', 'Bootstrap', 'MySQL'])
                . ' untuk '
                . fake()->randomElement([
                    'memudahkan pengelolaan data',
                    'mempercepat pencarian informasi',
                    'menyajikan laporan secara ringkas',
                    'mendukung kebutuhan pengguna sehari-hari',
                ]) . '.',
            'status' => fake()->randomElement(['draft', 'published']),
        ];
    }
}
