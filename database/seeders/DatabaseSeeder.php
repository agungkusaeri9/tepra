<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\PenyerapanAnggaran;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(
            [
                UserTableSeeder::class,
                TriwulanSeeder::class,
                JenisBarangJasaSeeder::class,
                PendapatanSeeder::class,
                PermasalahanPendapatanSeeder::class,
                PenarikanDanaAnggaranSeeder::class,
                PermasalahanPenarikanDanaAnggaranSeeder::class,
                PenyerapanAnggaranSeeder::class,
                PendanaanPenangananCovid19Seeder::class
            ]
        );
    }
}
