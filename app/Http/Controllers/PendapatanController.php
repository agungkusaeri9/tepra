<?php

namespace App\Http\Controllers;

use App\Models\Pendapatan;
use App\Models\PendapatanDetail;
use App\Models\Triwulan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PendapatanController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'skpd')
            $items = Pendapatan::where('user_id', auth()->id())->orderBy('jenis_pendapatan', 'ASC')->get();
        else
            $items = Pendapatan::orderBy('jenis_pendapatan', 'ASC')->get();
        return view('pages.pendapatan.index', [
            'title' => 'Data Pendapatan',
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.pendapatan.create', [
            'title' => 'Tambah Pendapatan',
            'data_triwulan' => Triwulan::orderBy('nama', 'ASC')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'jenis_pendapatan' => ['required'],
            'triwulan_id' => ['array'],
            'triwulan_id.*' => ['required', 'numeric', 'distinct'],
            'target_pendapatan' => ['array'],
            'target_pendapatan.*' => ['required', 'numeric'],
            'realisasi_pendapatan' => ['array'],
            'realisasi_pendapatan.*' => ['required', 'numeric'],
        ]);

        DB::beginTransaction();

        try {
            $data = request()->only(['jenis_pendapatan']);
            $data['user_id'] = auth()->id();
            $pendapatan = Pendapatan::create($data);
            $arr_triwulan = request('triwulan_id');
            $arr_target_pendapatan = request('target_pendapatan');
            $arr_realisasi_pendapatan = request('realisasi_pendapatan');

            foreach ($arr_triwulan as $key => $triwulan) {
                $pendapatan->details()->create([
                    'triwulan_id' => $triwulan,
                    'target_pendapatan' => $arr_target_pendapatan[$key],
                    'realisasi_pendapatan' => $arr_realisasi_pendapatan[$key]
                ]);
            }
            DB::commit();
            return redirect()->route('pendapatans.index')->with('success', 'Pendapatan berhasil ditambahkan.');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->route('pendapatans.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Pendapatan::with('details')->where([
            'user_id' => auth()->id(),
            'id' => $id
        ])->firstOrFail();

        return view('pages.pendapatan.show', [
            'title' => 'Detai Pendapatan',
            'item' => $item
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Pendapatan::with('details')->where([
            'user_id' => auth()->id(),
            'id' => $id
        ])->firstOrFail();
        return view('pages.pendapatan.edit', [
            'title' => 'Edit Pendapatan',
            'item' => $item,
            'data_triwulan' => Triwulan::orderBy('nama', 'ASC')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        request()->validate([
            'jenis_pendapatan' => ['required'],
            'triwulan_id' => ['array'],
            'triwulan_id.*' => ['required', 'numeric', 'distinct'],
            'target_pendapatan' => ['array'],
            'target_pendapatan.*' => ['required', 'numeric'],
            'realisasi_pendapatan' => ['array'],
            'realisasi_pendapatan.*' => ['required', 'numeric'],
        ]);


        DB::beginTransaction();

        try {
            // hapus keseluruhan pendapatan detail
            PendapatanDetail::where('pendapatan_id', $id)->delete();

            $data = request()->only(['jenis_pendapatan']);
            $pendapatan = Pendapatan::with('details')->where([
                'user_id' => auth()->id(),
                'id' => $id
            ])->firstOrFail();

            $pendapatan->update($data);
            $arr_triwulan = request('triwulan_id');
            $arr_target_pendapatan = request('target_pendapatan');
            $arr_realisasi_pendapatan = request('realisasi_pendapatan');

            foreach ($arr_triwulan as $key => $triwulan) {
                $pendapatan->details()->create([
                    'triwulan_id' => $triwulan,
                    'target_pendapatan' => $arr_target_pendapatan[$key],
                    'realisasi_pendapatan' => $arr_realisasi_pendapatan[$key]
                ]);
            }

            DB::commit();
            return redirect()->route('pendapatans.index')->with('success', 'Pendapatan berhasil disimpan.');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->route('pendapatans.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Pendapatan::findOrFail($id);

        DB::beginTransaction();

        try {
            $item->delete();
            DB::commit();
            return redirect()->route('pendapatans.index')->with('success', 'Pendapatan berhasil dihapus.');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
