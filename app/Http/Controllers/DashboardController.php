<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\JenisBarangJasa;
use App\Models\PenarikanDanaAnggaran;
use App\Models\PendanaanPenangananCovid19;
use App\Models\Pendapatan;
use App\Models\PenyerapanAnggaran;
use App\Models\PermasalahanPbj;
use App\Models\PermasalahanPenarikanDanaAnggaran;
use App\Models\PermasalahanPendapatan;
use App\Models\Triwulan;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'operator') {

            $operator = [
                'jumlah_user' => User::count(),
                'jumlah_jenis_barjas' => JenisBarangJasa::count(),
                'jumlah_triwulan' => Triwulan::count()
            ];
        }
        if (auth()->user()->role === 'skpd') {

            $skpd = [
                'jumlah_pendapatan' => Pendapatan::count(),
                'jumlah_penyerapan_anggaran' => PenyerapanAnggaran::count(),
                'jumlah_penanganan_covid' => PendanaanPenangananCovid19::count(),
                'jumlah_penarikan_dana' => PenarikanDanaAnggaran::count()
            ];
        }
        if (auth()->user()->role === 'tim tepra') {

            $tim_tepra = [
                'jumlah_permasalahan_pendapatan' => PermasalahanPendapatan::count(),
                'jumlah_permasalahan_anggaran' => PermasalahanPenarikanDanaAnggaran::count(),
                'jumlah_permasalahan_pbj' => PermasalahanPbj::count()
            ];
        }


        return view('pages.dashboard', [
            'title' => 'Dashboard',
            'operator' => $operator ?? [],
            'skpd' => $skpd ?? [],
            'tim_tepra' => $tim_tepra ?? []
        ]);
    }
}
