<?php

namespace Database\Seeders;

use App\Models\PermasalahanPendapatan;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermasalahanPendapatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PermasalahanPendapatan::create([
            'permasalahan' => 'Masalah Pertama',
            'penyebab' => 'Penyebab Pertama',
            'rekomendasi' => NULL,
            'user_id' => User::find(1)->id,
            'tim_tepra_user_id' => NULL
        ]);
    }
}
