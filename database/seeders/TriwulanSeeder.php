<?php

namespace Database\Seeders;

use App\Models\Triwulan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TriwulanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Triwulan::create([
            'nama' => 'Triwulan 1',
            'bulan_awal' => 01,
            'tahun_awal' => 2023,
            'bulan_akhir' => 04,
            'tahun_akhir' => 2023
        ]);

        Triwulan::create([
            'nama' => 'Triwulan 2',
            'bulan_awal' => 05,
            'tahun_awal' => 2023,
            'bulan_akhir' => 07,
            'tahun_akhir' => 2023
        ]);

        Triwulan::create([
            'nama' => 'Triwulan 3',
            'bulan_awal' => 07,
            'tahun_awal' => 2023,
            'bulan_akhir' => 10,
            'tahun_akhir' => 2023
        ]);

        Triwulan::create([
            'nama' => 'Triwulan 4',
            'bulan_awal' => 10,
            'tahun_awal' => 2023,
            'bulan_akhir' => 12,
            'tahun_akhir' => 2023
        ]);
    }
}
