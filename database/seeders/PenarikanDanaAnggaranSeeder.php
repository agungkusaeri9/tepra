<?php

namespace Database\Seeders;

use App\Models\PenarikanDanaAnggaran;
use App\Models\Triwulan;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenarikanDanaAnggaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $penarikan =  PenarikanDanaAnggaran::create([
            'jenis_belanja' => 'Penarikan Dana Anggaran A',
            'user_id' => User::find(1)->id
        ]);

        $penarikan->details()->create([
            'triwulan_id' => Triwulan::find(1)->id,
            'target_belanja' => 1000000,
            'realisasi_belanja' => 70000000
        ]);
        $penarikan->details()->create([
            'triwulan_id' => Triwulan::find(2)->id,
            'target_belanja' => 1000000,
            'realisasi_belanja' => 50000000
        ]);
        $penarikan->details()->create([
            'triwulan_id' => Triwulan::find(3)->id,
            'target_belanja' => 1000000,
            'realisasi_belanja' => 40000000
        ]);
        $penarikan->details()->create([
            'triwulan_id' => Triwulan::find(4)->id,
            'target_belanja' => 1000000,
            'realisasi_belanja' => 20000000
        ]);
    }
}
