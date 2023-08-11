<?php

namespace Database\Seeders;

use App\Models\TargetPbj;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TargetPbjSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $target_pbj = TargetPbj::create([
            'triwulan_id' => 1,
            'user_id' => 1
        ]);

        $target_pbj->details()->create([
            'jenis_barang_jasa_id' => 1,
            'paket' => 0,
            'nilai' => 0
        ]);
    }
}
