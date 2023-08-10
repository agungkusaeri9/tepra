<?php

namespace App\Http\Controllers;

use App\Models\PermasalahanPendapatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermasalahanPendapatanController extends Controller
{
    public function index()
    {
        $items = PermasalahanPendapatan::latest()->get();
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
}
