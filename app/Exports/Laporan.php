<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class Laporan implements FromView
{

    public $triwulan_id;
    public function __construct($triwulan_id)
    {
        $this->triwulan_id = $triwulan_id;
    }


    public function view(): View
    {
        return view('pages.laporan.excel');
    }
}
