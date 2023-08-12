<?php

namespace App\Exports;

use App\Models\JenisBarangJasa;
use App\Models\PenarikanDanaAnggaran;
use App\Models\PendanaanPenangananCovid19;
use App\Models\Pendapatan;
use App\Models\PenyerapanAnggaran;
use App\Models\PermasalahanPbj;
use App\Models\PermasalahanPenarikanDanaAnggaran;
use App\Models\PermasalahanPendapatan;
use App\Models\RealisasiPbj;
use App\Models\TargetPbj;
use App\Models\Triwulan;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class Laporan implements FromView
{

    public $user_id;
    public function __construct($user_id)
    {
        $this->user_id = $user_id;
    }


    public function view(): View
    {
        $data_pendapatan = Pendapatan::where('user_id', $this->user_id);
        $data_penarikan_dana_anggaran = PenarikanDanaAnggaran::where('user_id', $this->user_id);
        $data_triwulan = Triwulan::orderBy('nama', 'ASC')->get();
        $data_permasalahan_pendapatan = PermasalahanPendapatan::where('user_id', $this->user_id)->latest()->get();
        $data_permasalahan_anggaran = PermasalahanPenarikanDanaAnggaran::where('user_id', $this->user_id)->latest()->get();
        $data_penyerapan_anggaran_urusan = PenyerapanAnggaran::where('user_id', $this->user_id)->latest()->get();
        $data_pendanaan_covid19 = PendanaanPenangananCovid19::where('user_id', $this->user_id)->latest()->get();
        $data_jenis_barjas = JenisBarangJasa::orderBy('nama', 'ASC')->get();
        $data_target_pbj = TargetPbj::where('user_id', $this->user_id)->with('triwulan')->get();
        $data_realisasi_pbj = RealisasiPbj::where('user_id', $this->user_id)->get();
        $data_permasalahan_pbj = PermasalahanPbj::where('user_id', $this->user_id);
        $user = User::findOrFail($this->user_id);
        $triwulan_awal = Triwulan::orderBy('id', 'ASC')->first()->nama ?? '';
        $triwulan_akhir = Triwulan::orderBy('id', 'DESC')->first()->nama ?? '';
        $triwulan_akhir_tahun = Triwulan::orderBy('id', 'DESC')->first()->tahun_akhir ?? '';
        return view('pages.laporan.excel', [
            'data_pendapatan' => $data_pendapatan,
            'data_triwulan' => $data_triwulan,
            'data_permasalahan_pendapatan' => $data_permasalahan_pendapatan,
            'data_penarikan_dana_anggaran' => $data_penarikan_dana_anggaran,
            'data_permasalahan_anggaran' => $data_permasalahan_anggaran,
            'data_penyerapan_anggaran_urusan' => $data_penyerapan_anggaran_urusan,
            'data_pendanaan_covid19' => $data_pendanaan_covid19,
            'data_jenis_barjas' => $data_jenis_barjas,
            'data_target_pbj' => $data_target_pbj,
            'data_realisasi_pbj' => $data_realisasi_pbj,
            'data_permasalahan_pbj' => $data_permasalahan_pbj,
            'user' => $user,
            'triwulan_awal' => $triwulan_awal,
            'triwulan_akhir' => $triwulan_akhir,
            'triwulan_akhir_tahun' => $triwulan_akhir_tahun
        ]);
    }
}
