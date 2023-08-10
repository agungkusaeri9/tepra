<?php

namespace Database\Seeders;

use App\Models\JenisBarangJasa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisBarangJasaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JenisBarangJasa::create([
            'nama' => 'Pelelangan'
        ]);

        JenisBarangJasa::create([
            'nama' => 'E Katalog'
        ]);

        JenisBarangJasa::create([
            'nama' => 'Juksung'
        ]);

        JenisBarangJasa::create([
            'nama' => 'Dasung'
        ]);

        JenisBarangJasa::create([
            'nama' => 'Swakelola'
        ]);
    }
}
