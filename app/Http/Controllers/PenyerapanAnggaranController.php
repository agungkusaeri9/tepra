<?php

namespace App\Http\Controllers;

use App\Models\PenyerapanAnggaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PenyerapanAnggaranController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'skpd')
            $items = PenyerapanAnggaran::where('user_id', auth()->id())->latest()->get();
        else
            $items = PenyerapanAnggaran::latest()->get();
        return view('pages.penyerapan-anggaran.index', [
            'title' => 'Data Penyerapan Anggaran',
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
        return view('pages.penyerapan-anggaran.create', [
            'title' => 'Tambah Penyerapan Anggaran',
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
            'urusan_pemerintahan' => ['required'],
            'target' => ['required'],
            'realisasi' => ['required']
        ]);

        DB::beginTransaction();

        try {
            $data = request()->all();
            $data['user_id'] = auth()->id();
            PenyerapanAnggaran::create($data);
            DB::commit();
            return redirect()->route('penyerapan-anggarans.index')->with('success', 'Penyerapan Anggaran berhasil ditambahkan.');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->route('penyerapan-anggarans.index')->with('error', $th->getMessage());
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
        $item = PenyerapanAnggaran::where([
            'id' => $id,
            'user_id' => auth()->id()
        ])->firstOrFail();
        return view('pages.penyerapan-anggaran.edit', [
            'title' => 'Edit Penyerapan Anggaran',
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
            'urusan_pemerintahan' => ['required'],
            'target' => ['required'],
            'realisasi' => ['required']
        ]);

        DB::beginTransaction();

        try {
            $item = PenyerapanAnggaran::where([
                'id' => $id,
                'user_id' => auth()->id()
            ])->firstOrFail();
            $data = request()->all();
            $item->update($data);
            DB::commit();
            return redirect()->route('penyerapan-anggarans.index')->with('success', 'Penyerapan Anggaran berhasil disimpan.');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->route('penyerapan-anggarans.index')->with('error', $th->getMessage());
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
        $item = PenyerapanAnggaran::where([
            'id' => $id,
            'user_id' => auth()->id()
        ])->firstOrFail();

        DB::beginTransaction();

        try {
            $item->delete();
            DB::commit();
            return redirect()->route('penyerapan-anggarans.index')->with('success', 'Penyerapan Anggaran berhasil dihapus.');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->route('penyerapan-anggarans.index')->with('error', $th->getMessage());
        }
    }
}
