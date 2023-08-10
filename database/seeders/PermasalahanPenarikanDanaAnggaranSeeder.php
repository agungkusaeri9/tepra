<?php

namespace Database\Seeders;

use App\Models\PermasalahanPenarikanDanaAnggaran;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermasalahanPenarikanDanaAnggaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PermasalahanPenarikanDanaAnggaran::create([
            'permasalahan' => 'Masalah belanja Pertama',
            'penyebab' => 'Penyebab belanja Pertama',
            'rekomendasi' => NULL,
            'user_id' => User::find(1)->id,
            'tim_tepra_user_id' => NULL
        ]);
    }
}
