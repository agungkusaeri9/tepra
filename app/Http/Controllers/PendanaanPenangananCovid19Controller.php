<?php

namespace App\Http\Controllers;

use App\Models\PendanaanPenangananCovid19;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PendanaanPenangananCovid19Controller extends Controller
{
    public function index()
    {
        $items = PendanaanPenangananCovid19::latest()->get();
        return view('pages.pendanaan-penanganan-covid19.index', [
            'title' => 'Data Pendanaan Penanganan Covid 19',
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
        return view('pages.pendanaan-penanganan-covid19.create', [
            'title' => 'Tambah Pendanaan Penanganan Covid 19',
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
            'fokus' => ['required'],
            'program' => ['required'],
            'target' => ['required'],
            'realisasi' => ['required']
        ]);

        DB::beginTransaction();

        try {
            $data = request()->all();
            $data['user_id'] = auth()->id();
            PendanaanPenangananCovid19::create($data);
            DB::commit();
            return redirect()->route('pendanaan-penanganan-covid19.index')->with('success', 'Pendanaan Penanganan Covid 19 berhasil ditambahkan.');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->route('pendanaan-penanganan-covid19.index')->with('error', $th->getMessage());
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
        $item = PendanaanPenangananCovid19::where([
            'id' => $id,
            'user_id' => auth()->id()
        ])->firstOrFail();
        return view('pages.pendanaan-penanganan-covid19.edit', [
            'title' => 'Edit Pendanaan Penanganan Covid 19',
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
            'fokus' => ['required'],
            'program' => ['required'],
            'target' => ['required'],
            'realisasi' => ['required']
        ]);

        DB::beginTransaction();

        try {
            $item = PendanaanPenangananCovid19::where([
                'id' => $id,
                'user_id' => auth()->id()
            ])->firstOrFail();
            $data = request()->all();
            $item->update($data);
            DB::commit();
            return redirect()->route('pendanaan-penanganan-covid19.index')->with('success', 'Pendanaan Penanganan Covid 19 berhasil disimpan.');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->route('pendanaan-penanganan-covid19.index')->with('error', $th->getMessage());
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
        $item = PendanaanPenangananCovid19::where([
            'id' => $id,
            'user_id' => auth()->id()
        ])->firstOrFail();

        DB::beginTransaction();

        try {
            $item->delete();
            DB::commit();
            return redirect()->route('pendanaan-penanganan-covid19.index')->with('success', 'Pendanaan Penanganan Covid 19 berhasil dihapus.');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->route('pendanaan-penanganan-covid19.index')->with('error', $th->getMessage());
        }
    }
}
