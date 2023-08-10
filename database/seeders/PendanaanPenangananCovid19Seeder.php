<?php

namespace Database\Seeders;

use App\Models\PendanaanPenangananCovid19;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PendanaanPenangananCovid19Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PendanaanPenangananCovid19::create([
            'fokus' => 'Fokus A',
            'program' => 'Program A',
            'target' => 100000,
            'realisasi' => 50000,
            'user_id' => User::find(1)->id
        ]);
    }
}
