<?php

namespace App\Http\Controllers;

use App\Models\PermasalahanPbj;
use App\Models\Triwulan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermasalahanPbjController extends Controller
{
    public function __construct()
    {
        $this->middleware('cekRole:skpd')->only(['create', 'store', 'edit', 'update', 'delete']);
    }

    public function index()
    {
        if (auth()->user()->role === 'skpd')
            $items = PermasalahanPbj::where('user_id', auth()->id())->latest()->get();
        else
            $items = PermasalahanPbj::latest()->get();
        return view('pages.permasalahan-pbj.index', [
            'title' => 'Data Permasalahan PBJ',
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
        return view('pages.permasalahan-pbj.create', [
            'title' => 'Tambah Permasalahan PBJ',
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
            'triwulan_id' => ['required'],
            'permasalahan' => ['required'],
            'penyebab' => ['required']
        ]);

        DB::beginTransaction();

        try {
            $data = request()->all();
            $data['user_id'] = auth()->id();
            PermasalahanPbj::create($data);
            DB::commit();
            return redirect()->route('permasalahan-pbjs.index')->with('success', 'Permasalahan PBJ berhasil ditambahkan.');
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
            $item = PermasalahanPbj::where('user_id', auth()->id())->where('id', $id)->firstOrFail();
        else
            $item = PermasalahanPbj::findOrFail($id);

        return view('pages.permasalahan-pbj.edit', [
            'title' => 'Edit Permasalahan PBJ',
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
            'triwulan_id' => ['required'],
            'permasalahan' => ['required'],
            'penyebab' => ['required']
        ]);

        DB::beginTransaction();

        try {
            $item = PermasalahanPbj::findOrFail($id);
            $data = request()->all();
            $item->update($data);
            DB::commit();
            return redirect()->route('permasalahan-pbjs.index')->with('success', 'Permasalahan PBJ berhasil disimpan.');
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
        $item = PermasalahanPbj::findOrFail($id);

        DB::beginTransaction();

        try {
            $item->delete();
            DB::commit();
            return redirect()->route('permasalahan-pbjs.index')->with('success', 'Permasalahan PBJ berhasil dihapus.');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function rekomendasi($id)
    {
        $item = PermasalahanPbj::findOrFail($id);

        // cek apakah sudah punya rekomendasi
        if ($item->rekomendasi && $item->timTepra) {
            return redirect()->route('permasalahan-pbjs.index')->with('error', 'Permasalahan PBJ sudah di cek Tim Tepra');
        }
        return view('pages.permasalahan-pbj.rekomendasi', [
            'title' => 'Rekomendasi Permasalahan PBJ',
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
            $item = PermasalahanPbj::findOrFail($id);
            $item->update([
                'rekomendasi' => request('rekomendasi'),
                'tim_tepra_user_id' => auth()->id()
            ]);

            DB::commit();
            return redirect()->route('permasalahan-pbjs.index')->with('success', 'Rekomendasi Permasalahan PBJ berhasil ditambahkan.');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
