<?php

namespace Database\Seeders;

use App\Models\PermasalahanPbj;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermasalahanPbjSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PermasalahanPbj::create([
            'permasalahan' => 'Masalah Pertama',
            'penyebab' => 'Penyebab Pertama',
            'triwulan_id' => 1,
            'rekomendasi' => NULL,
            'user_id' => 1,
            'tim_tepra_user_id' => NULL
        ]);
    }
}
