<?php

namespace App\Http\Controllers;

use App\Models\JenisBarangJasa;
use App\Models\TargetPbj;
use App\Models\TargetPbjDetail;
use App\Models\Triwulan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class TargetPbjController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'skpd')
            $items = TargetPbj::where('user_id', auth()->id())->latest()->get();
        else
            $items = TargetPbj::latest()->get();
        return view('pages.target-pbj.index', [
            'title' => 'Data Target PBJ',
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
        return view('pages.target-pbj.create', [
            'title' => 'Tambah Target PBJ',
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
            'triwulan_id' => ['required', 'unique:target_pbjs,triwulan_id'],
            'jenis_barang_jasa_id' => ['array'],
            'jenis_barang_jasa_id.*' => ['required', 'numeric', 'distinct'],
            'paket' => ['array'],
            'paket.*' => ['required', 'numeric'],
            'nilai' => ['array'],
            'nilai.*' => ['required', 'numeric'],
        ]);

        DB::beginTransaction();

        try {
            $data = request()->only(['triwulan_id']);
            $data['user_id'] = auth()->id();
            $target_pbj = TargetPbj::create($data);
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
            return redirect()->route('target-pbjs.index')->with('success', 'Target PBJ berhasil ditambahkan.');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->route('target-pbjs.index')->with('error', $th->getMessage());
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
        $item = TargetPbj::with('details.jenis')->where([
            'user_id' => auth()->id(),
            'id' => $id
        ])->firstOrFail();

        return view('pages.target-pbj.show', [
            'title' => 'Detail Target PBJ',
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
        $item = TargetPbj::with('details')->where([
            'user_id' => auth()->id(),
            'id' => $id
        ])->firstOrFail();
        return view('pages.target-pbj.edit', [
            'title' => 'Edit Target PBJ',
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
            'triwulan_id' => ['required', Rule::unique('target_pbjs', 'triwulan_id')->ignore($id)],
            'jenis_barang_jasa_id' => ['array'],
            'jenis_barang_jasa_id.*' => ['required', 'numeric', 'distinct'],
            'paket' => ['array'],
            'paket.*' => ['required', 'numeric'],
            'nilai' => ['array'],
            'nilai.*' => ['required', 'numeric'],
        ]);


        DB::beginTransaction();

        try {
            // hapus keseluruhan Target PBJ detail
            TargetPbjDetail::where('target_pbj_id', $id)->delete();

            $data = request()->only(['triwulan_id']);
            $target_pbj = TargetPbj::with('details')->where([
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
            return redirect()->route('target-pbjs.index')->with('success', 'Target PBJ berhasil disimpan.');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->route('target-pbjs.index')->with('error', $th->getMessage());
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
        $item = TargetPbj::findOrFail($id);

        DB::beginTransaction();

        try {
            $item->delete();
            DB::commit();
            return redirect()->route('target-pbjs.index')->with('success', 'Target PBJ berhasil dihapus.');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
