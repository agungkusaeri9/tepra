<?php

namespace App\Http\Controllers;

use App\Exports\Laporan;
use App\Models\Triwulan;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{

    public function __construct()
    {
        $this->middleware('cekRole:skpd,tim tepra');
    }

    public function index()
    {
        return view('pages.laporan.index', [
            'title' => 'Laporan',
            'data_user' => User::where('role', 'skpd')->orderBy('name', 'ASC')->get()
        ]);
    }

    public function excel()
    {
        request()->validate([
            'user_id' => ['required']
        ]);

        $user_id = request('user_id');
        $fileName = User::find($user_id)->name . '.xlsx';
        return Excel::download(new Laporan($user_id), $fileName);
    }
}
