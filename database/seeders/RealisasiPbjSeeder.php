<?php

namespace Database\Seeders;

use App\Models\RealisasiPbj;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RealisasiPbjSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realisasi_pbj = RealisasiPbj::create([
            'triwulan_id' => 1,
            'tahapan' => 'Tahapan A',
            'user_id' => 1
        ]);

        $realisasi_pbj->details()->create([
            'jenis_barang_jasa_id' => 1,
            'paket' => 0,
            'nilai' => 0
        ]);
    }
}
