<?php

namespace App\Http\Controllers;

use App\Models\PermasalahanPenarikanDanaAnggaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermasalahanPenarikanDanaAnggaranController extends Controller
{
    public function index()
    {
        $items = PermasalahanPenarikanDanaAnggaran::latest()->get();
        return view('pages.permasalahan-anggaran.index', [
            'title' => 'Data Permasalahan Anggaran',
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
        return view('pages.permasalahan-anggaran.create', [
            'title' => 'Tambah Permasalahan Anggaran',
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
            'permasalahan' => ['required'],
            'penyebab' => ['required']
        ]);

        DB::beginTransaction();

        try {
            $data = request()->all();
            $data['user_id'] = auth()->id();
            PermasalahanPenarikanDanaAnggaran::create($data);
            DB::commit();
            return redirect()->route('permasalahan-anggarans.index')->with('success', 'Permasalahan Anggaran berhasil ditambahkan.');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->route('permasalahan-anggarans.index')->with('error', $th->getMessage());
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
        $item = PermasalahanPenarikanDanaAnggaran::findOrFail($id);
        return view('pages.permasalahan-anggaran.edit', [
            'title' => 'Edit Permasalahan Anggaran',
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
            'permasalahan' => ['required'],
            'penyebab' => ['required']
        ]);

        DB::beginTransaction();

        try {
            $item = PermasalahanPenarikanDanaAnggaran::findOrFail($id);
            $data = request()->all();
            $item->update($data);
            DB::commit();
            return redirect()->route('permasalahan-anggarans.index')->with('success', 'Permasalahan Anggaran berhasil disimpan.');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->route('permasalahan-anggarans.index')->with('error', $th->getMessage());
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
        $item = PermasalahanPenarikanDanaAnggaran::findOrFail($id);

        DB::beginTransaction();

        try {
            $item->delete();
            DB::commit();
            return redirect()->route('permasalahan-anggarans.index')->with('success', 'Permasalahan Anggaran berhasil dihapus.');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->route('permasalahan-anggarans.index')->with('error', $th->getMessage());
        }
    }
}
