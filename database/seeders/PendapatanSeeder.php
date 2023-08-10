<?php

namespace Database\Seeders;

use App\Models\Pendapatan;
use App\Models\Triwulan;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PendapatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // pendapatan 1
        $pendaptan1 = Pendapatan::create([
            'jenis_pendapatan' => 'Pendapatan A',
            'user_id' => User::find(1)->id
        ]);

        $pendaptan1->details()->create([
            'triwulan_id' => Triwulan::find(1)->id,
            'target_pendapatan' => 1000000,
            'realisasi_pendapatan' => 40000000
        ]);
        $pendaptan1->details()->create([
            'triwulan_id' => Triwulan::find(2)->id,
            'target_pendapatan' => 1000000,
            'realisasi_pendapatan' => 40000000
        ]);
        $pendaptan1->details()->create([
            'triwulan_id' => Triwulan::find(3)->id,
            'target_pendapatan' => 1000000,
            'realisasi_pendapatan' => 40000000
        ]);
        $pendaptan1->details()->create([
            'triwulan_id' => Triwulan::find(4)->id,
            'target_pendapatan' => 1000000,
            'realisasi_pendapatan' => 40000000
        ]);
    }
}
