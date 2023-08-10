<?php

namespace App\Http\Controllers;

use App\Models\Triwulan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class TriwulanController extends Controller
{
    public function index()
    {
        $items = Triwulan::orderBy('nama', 'ASC')->get();
        return view('pages.triwulan.index', [
            'title' => 'Data Triwulan',
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
        return view('pages.triwulan.create', [
            'title' => 'Tambah Triwulan',
            'data_bulan' => Triwulan::daftarBulan()
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
            'nama' => ['required', 'unique:triwulans,nama'],
            'bulan_awal' => ['required', 'numeric'],
            'tahun_awal' => ['required', 'numeric'],
            'bulan_akhir' => ['required', 'numeric'],
            'tahun_akhir' => ['required', 'numeric'],
        ]);

        DB::beginTransaction();

        try {
            $data = request()->all();

            Triwulan::create($data);
            DB::commit();
            return redirect()->route('triwulans.index')->with('success', 'Triwulan berhasil ditambahkan.');
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
        $item = Triwulan::findOrFail($id);
        return view('pages.triwulan.edit', [
            'title' => 'Edit Triwulan',
            'item' => $item,
            'data_bulan' => Triwulan::daftarBulan()
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
            'nama' => ['required', Rule::unique('triwulans')->ignore($id)],
            'bulan_awal' => ['required', 'numeric'],
            'tahun_awal' => ['required', 'numeric'],
            'bulan_akhir' => ['required', 'numeric'],
            'tahun_akhir' => ['required', 'numeric'],
        ]);

        DB::beginTransaction();

        try {
            $item = Triwulan::findOrFail($id);
            $data = request()->all();

            $item->update($data);
            DB::commit();
            return redirect()->route('triwulans.index')->with('success', 'Triwulan berhasil disimpan.');
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
        $item = Triwulan::findOrFail($id);

        DB::beginTransaction();

        try {
            $item->delete();
            DB::commit();
            return redirect()->route('triwulans.index')->with('success', 'Triwulan berhasil dihapus.');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
