<?php

namespace App\Http\Controllers;

use App\Models\PermasalahanPenarikanDanaAnggaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermasalahanPenarikanDanaAnggaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('cekRole:skpd')->only(['create', 'store', 'edit', 'update', 'delete']);
    }

    public function index()
    {
        if (auth()->user()->role === 'skpd')
            $items = PermasalahanPenarikanDanaAnggaran::where('user_id', auth()->id)->latest()->get();
        else
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
        if (auth()->user()->role === 'skpd')
            $item = PermasalahanPenarikanDanaAnggaran::where('user_id', auth()->id)->where('id', $id)->firstOrFail();
        else
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

    public function rekomendasi($id)
    {
        $item = PermasalahanPenarikanDanaAnggaran::findOrFail($id);

        // cek apakah sudah punya rekomendasi
        if ($item->rekomendasi && $item->timTepra) {
            return redirect()->route('permasalahan-anggarans.index')->with('error', 'Permasalahan Anggaran sudah di cek Tim Tepra');
        }
        return view('pages.permasalahan-anggaran.rekomendasi', [
            'title' => 'Rekomendasi Permasalahan Anggaran',
            'item' => $item
        ]);
    }

    public function rekomendasiStore($id)
    {
        request()->validate([
            'rekomendasi' => ['required']
        ]);

        DB::beginTransaction();
        try {
            $item = PermasalahanPenarikanDanaAnggaran::findOrFail($id);
            $item->update([
                'rekomendasi' => request('rekomendasi'),
                'tim_tepra_user_id' => auth()->id()
            ]);

            DB::commit();
            return redirect()->route('permasalahan-anggarans.index')->with('success', 'Rekomendasi Permasalahan Anggaran berhasil ditambahkan.');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
