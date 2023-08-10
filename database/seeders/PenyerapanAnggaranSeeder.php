<?php

namespace Database\Seeders;

use App\Models\PenyerapanAnggaran;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenyerapanAnggaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PenyerapanAnggaran::create([
            'urusan_pemerintahan' => 'Urusan Pemerintahan',
            'target' => 100000,
            'realisasi' => 50000,
            'user_id' => User::find(1)->id
        ]);
    }
}
