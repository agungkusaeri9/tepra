<?php

namespace App\Http\Controllers;

use App\Models\PenarikanDanaAnggaran;
use App\Models\PenarikanDanaAnggaranDetail;
use App\Models\Triwulan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenarikanDanaAnggaranController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'skpd')
            $items = PenarikanDanaAnggaran::where('user_id', auth()->id())->latest()->get();
        else
            $items = PenarikanDanaAnggaran::latest()->get();
        return view('pages.penarikan-dana-anggaran.index', [
            'title' => 'Data belanja',
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
        return view('pages.penarikan-dana-anggaran.create', [
            'title' => 'Tambah belanja',
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
            'jenis_belanja' => ['required'],
            'triwulan_id' => ['array'],
            'triwulan_id.*' => ['required', 'numeric', 'distinct'],
            'target_belanja' => ['array'],
            'target_belanja.*' => ['required', 'numeric'],
            'realisasi_belanja' => ['array'],
            'realisasi_belanja.*' => ['required', 'numeric'],
        ]);

        DB::beginTransaction();

        try {
            $data = request()->only(['jenis_belanja']);
            $data['user_id'] = auth()->id();
            $belanja = PenarikanDanaAnggaran::create($data);
            $arr_triwulan = request('triwulan_id');
            $arr_target_belanja = request('target_belanja');
            $arr_realisasi_belanja = request('realisasi_belanja');

            foreach ($arr_triwulan as $key => $triwulan) {
                $belanja->details()->create([
                    'triwulan_id' => $triwulan,
                    'target_belanja' => $arr_target_belanja[$key],
                    'realisasi_belanja' => $arr_realisasi_belanja[$key]
                ]);
            }
            DB::commit();
            return redirect()->route('penarikan-dana-anggarans.index')->with('success', 'Penarikan Dana Anggaran berhasil ditambahkan.');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->route('penarikan-dana-anggarans.index')->with('error', $th->getMessage());
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
        $item = PenarikanDanaAnggaran::with(['details.triwulan'])->where([
            'user_id' => auth()->id(),
            'id' => $id
        ])->firstOrFail();

        return view('pages.penarikan-dana-anggaran.show', [
            'title' => 'Detai belanja',
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
        $item = PenarikanDanaAnggaran::with('details')->where([
            'user_id' => auth()->id(),
            'id' => $id
        ])->firstOrFail();


        return view('pages.penarikan-dana-anggaran.edit', [
            'title' => 'Edit belanja',
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
            'jenis_belanja' => ['required'],
            'triwulan_id' => ['array'],
            'triwulan_id.*' => ['required', 'numeric', 'distinct'],
            'target_belanja' => ['array'],
            'target_belanja.*' => ['required', 'numeric'],
            'realisasi_belanja' => ['array'],
            'realisasi_belanja.*' => ['required', 'numeric'],
        ]);


        DB::beginTransaction();

        try {
            // hapus keseluruhan belanja detail
            PenarikanDanaAnggaranDetail::where('penarikan_anggaran_id', $id)->delete();

            $data = request()->only(['jenis_belanja']);
            $belanja = PenarikanDanaAnggaran::with('details')->where([
                'user_id' => auth()->id(),
                'id' => $id
            ])->firstOrFail();

            $belanja->update($data);
            $arr_triwulan = request('triwulan_id');
            $arr_target_belanja = request('target_belanja');
            $arr_realisasi_belanja = request('realisasi_belanja');

            foreach ($arr_triwulan as $key => $triwulan) {
                $belanja->details()->create([
                    'triwulan_id' => $triwulan,
                    'target_belanja' => $arr_target_belanja[$key],
                    'realisasi_belanja' => $arr_realisasi_belanja[$key]
                ]);
            }

            DB::commit();
            return redirect()->route('penarikan-dana-anggarans.index')->with('success', 'Penarikan Dana Anggaran berhasil disimpan.');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->route('penarikan-dana-anggarans.index')->with('error', $th->getMessage());
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
        $item = PenarikanDanaAnggaran::findOrFail($id);

        DB::beginTransaction();

        try {
            $item->delete();
            DB::commit();
            return redirect()->route('penarikan-dana-anggarans.index')->with('success', 'Penarikan Dana Anggaran berhasil dihapus.');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
