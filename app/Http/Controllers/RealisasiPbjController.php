<?php

namespace App\Http\Controllers;

use App\Models\JenisBarangJasa;
use App\Models\RealisasiPbj;
use App\Models\RealisasiPbjDetail;
use App\Models\Triwulan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RealisasiPbjController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'skpd')
            $items = RealisasiPbj::where('user_id', auth()->id())->latest()->get();
        else
            $items = RealisasiPbj::latest()->get();
        return view('pages.realisasi-pbj.index', [
            'title' => 'Data Realisasi PBJ',
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
        return view('pages.realisasi-pbj.create', [
            'title' => 'Tambah Realisasi PBJ',
            'data_triwulan' => Triwulan::orderBy('nama', 'ASC')->get(),
            'data_jenis_barjas' => JenisBarangJasa::orderBy('nama', 'ASC')->get()
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
            'tahapan' => ['required'],
            'triwulan_id' => ['required'],
            'jenis_barang_jasa_id' => ['array'],
            'jenis_barang_jasa_id.*' => ['required', 'numeric', 'distinct'],
            'paket' => ['array'],
            'paket.*' => ['required', 'numeric'],
            'nilai' => ['array'],
            'nilai.*' => ['required', 'numeric'],
        ]);

        DB::beginTransaction();

        try {
            $data = request()->only(['triwulan_id', 'tahapan']);
            $data['user_id'] = auth()->id();
            $realisasi_pbj = RealisasiPbj::create($data);
            $arr_jenis_barang_jasa = request('jenis_barang_jasa_id');
            $arr_paket = request('paket');
            $arr_nilai = request('nilai');

            foreach ($arr_jenis_barang_jasa as $key => $triwulan) {
                $realisasi_pbj->details()->create([
                    'jenis_barang_jasa_id' => $triwulan,
                    'paket' => $arr_paket[$key],
                    'nilai' => $arr_nilai[$key]
                ]);
            }
            DB::commit();
            return redirect()->route('realisasi-pbjs.index')->with('success', 'Realisasi PBJ berhasil ditambahkan.');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->route('realisasi-pbjs.index')->with('error', $th->getMessage());
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
        $item = RealisasiPbj::with('details.jenis')->where([
            'user_id' => auth()->id(),
            'id' => $id
        ])->firstOrFail();

        return view('pages.realisasi-pbj.show', [
            'title' => 'Detail Realisasi PBJ',
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
        $item = RealisasiPbj::with('details')->where([
            'user_id' => auth()->id(),
            'id' => $id
        ])->firstOrFail();
        return view('pages.realisasi-pbj.edit', [
            'title' => 'Edit Realisasi PBJ',
            'item' => $item,
            'data_triwulan' => Triwulan::orderBy('nama', 'ASC')->get(),
            'data_jenis_barjas' => JenisBarangJasa::orderBy('nama', 'ASC')->get()
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
            'tahapan' => ['required'],
            'triwulan_id' => ['required'],
            'jenis_barang_jasa_id' => ['array'],
            'jenis_barang_jasa_id.*' => ['required', 'numeric', 'distinct'],
            'paket' => ['array'],
            'paket.*' => ['required', 'numeric'],
            'nilai' => ['array'],
            'nilai.*' => ['required', 'numeric'],
        ]);


        DB::beginTransaction();

        try {
            // hapus keseluruhan Realisasi PBJ detail
            RealisasiPbjDetail::where('realisasi_pbj_id', $id)->delete();

            $data = request()->only(['triwulan_id', 'tahapan']);
            $target_pbj = RealisasiPbj::with('details')->where([
                'user_id' => auth()->id(),
                'id' => $id
            ])->firstOrFail();

            $target_pbj->update($data);

            $arr_jenis_barang_jasa = request('jenis_barang_jasa_id');
            $arr_paket = request('paket');
            $arr_nilai = request('nilai');

            foreach ($arr_jenis_barang_jasa as $key => $triwulan) {
                $target_pbj->details()->create([
                    'jenis_barang_jasa_id' => $triwulan,
                    'paket' => $arr_paket[$key],
                    'nilai' => $arr_nilai[$key]
                ]);
            }

            DB::commit();
            return redirect()->route('realisasi-pbjs.index')->with('success', 'Realisasi PBJ berhasil disimpan.');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->route('realisasi-pbjs.index')->with('error', $th->getMessage());
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
        $item = RealisasiPbj::findOrFail($id);

        DB::beginTransaction();

        try {
            $item->delete();
            DB::commit();
            return redirect()->route('realisasi-pbjs.index')->with('success', 'Realisasi PBJ berhasil dihapus.');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
