<?php

namespace App\Http\Controllers;

use App\Models\PermasalahanPendapatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermasalahanPendapatanController extends Controller
{

    public function __construct()
    {
        $this->middleware('cekRole:skpd,tim tepra')->only(['index']);
        $this->middleware('cekRole:skpd')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    public function index()
    {
        if (auth()->user()->role === 'skpd')
            $items = PermasalahanPendapatan::where('user_id', auth()->id())->with('timTepra')->latest()->get();
        else
            $items = PermasalahanPendapatan::with('timTepra')->latest()->get();

        return view('pages.permasalahan-pendapatan.index', [
            'title' => 'Data Permasalahan Pendapatan',
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
        return view('pages.permasalahan-pendapatan.create', [
            'title' => 'Tambah Permasalahan Pendapatan',
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
            PermasalahanPendapatan::create($data);
            DB::commit();
            return redirect()->route('permasalahan-pendapatans.index')->with('success', 'Permasalahan Pendapatan berhasil ditambahkan.');
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
        if (auth()->user()->role === 'skpd')
            $item = PermasalahanPendapatan::where('user_id', auth()->id())->with('timTepra')->where('id', $id)->firstOrFail();
        else
            $item = PermasalahanPendapatan::findOrFail($id);

        return view('pages.permasalahan-pendapatan.edit', [
            'title' => 'Edit Permasalahan Pendapatan',
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
            $item = PermasalahanPendapatan::findOrFail($id);
            $data = request()->all();
            $item->update($data);
            DB::commit();
            return redirect()->route('permasalahan-pendapatans.index')->with('success', 'Permasalahan Pendapatan berhasil disimpan.');
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
        $item = PermasalahanPendapatan::findOrFail($id);

        DB::beginTransaction();

        try {
            $item->delete();
            DB::commit();
            return redirect()->route('permasalahan-pendapatans.index')->with('success', 'Permasalahan Pendapatan berhasil dihapus.');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function rekomendasi($id)
    {
        $item = PermasalahanPendapatan::findOrFail($id);

        // cek apakah sudah punya rekomendasi
        if ($item->rekomendasi && $item->timTepra) {
            return redirect()->route('permasalahan-pendapatans.index')->with('error', 'Permasalahan Pendapatan sudah di cek Tim Tepra');
        }
        return view('pages.permasalahan-pendapatan.rekomendasi', [
            'title' => 'Rekomendasi Permasalahan Pendapatan',
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
            $item = PermasalahanPendapatan::findOrFail($id);
            $item->update([
                'rekomendasi' => request('rekomendasi'),
                'tim_tepra_user_id' => auth()->id()
            ]);

            DB::commit();
            return redirect()->route('permasalahan-pendapatans.index')->with('success', 'Rekomendasi Permasalahan Pendapatan berhasil ditambahkan.');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
