<?php

namespace App\Http\Controllers;

use App\Exports\Laporan;
use App\Models\Triwulan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function index()
    {
        return view('pages.laporan.index', [
            'title' => 'Laporan',
            'data_triwulan' => Triwulan::orderBy('nama', 'ASC')->get()
        ]);
    }

    public function excel()
    {
        $triwulan_id = request('triwulan_id');
        return Excel::download(new Laporan($triwulan_id), 'Laporan.xlsx');
    }
}
