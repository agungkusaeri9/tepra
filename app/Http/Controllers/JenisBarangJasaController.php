<?php

namespace App\Http\Controllers;

use App\Models\JenisBarangJasa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class JenisBarangJasaController extends Controller
{
    public function index()
    {
        $items = JenisBarangJasa::orderBy('nama', 'ASC')->get();
        return view('pages.jenis-barang-jasa.index', [
            'title' => 'Data Jenis Barang Jasa',
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
        return view('pages.jenis-barang-jasa.create', [
            'title' => 'Tambah Jenis Barang Jasa',
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
            'nama' => ['required', 'unique:jenis_barang_jasas,nama']
        ]);

        DB::beginTransaction();

        try {
            $data = request()->all();

            JenisBarangJasa::create($data);
            DB::commit();
            return redirect()->route('jenis-barang-jasa.index')->with('success', 'Jenis Barang Jasa berhasil ditambahkan.');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = JenisBarangJasa::findOrFail($id);
        return view('pages.jenis-barang-jasa.edit', [
            'title' => 'Edit Jenis Barang Jasa',
            'item' => $item
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
            'nama' => ['required', Rule::unique('jenis_barang_jasas')->ignore($id)],
        ]);

        DB::beginTransaction();

        try {
            $item = JenisBarangJasa::findOrFail($id);
            $data = request()->all();

            $item->update($data);
            DB::commit();
            return redirect()->route('jenis-barang-jasa.index')->with('success', 'Jenis Barang Jasa berhasil disimpan.');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
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
        $item = JenisBarangJasa::findOrFail($id);

        DB::beginTransaction();

        try {
            $item->delete();
            DB::commit();
            return redirect()->route('jenis-barang-jasa.index')->with('success', 'Jenis Barang Jasa berhasil dihapus.');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
