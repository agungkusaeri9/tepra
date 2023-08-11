@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Detail Target PBJ</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('target-pbjs.index') }}">Target PBJ</a>
                </div>
                <div class="breadcrumb-item">Detail Target PBJ</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-4">Target PBJ</h6>
                            <ul class="list-inline">
                                <li class="list-inline-item d-flex mb-2 justify-content-between">
                                    <span class="font-weight-bold">Triwulan</span>
                                    <span>{{ $item->triwulan->nama }}</span>
                                </li>
                                <li class="list-inline-item d-flex mb-2 justify-content-between">
                                    <span class="font-weight-bold">Waktu</span>
                                    <span>{{ $item->triwulan->rentangWaktu() }}</span>
                                </li>
                                <li class="list-inline-item d-flex mb-2 justify-content-between">
                                    <span class="font-weight-bold">Dibuat</span>
                                    <span>{{ $item->created_at->translatedFormat('d-m-Y') }}</span>
                                </li>
                                <li class="list-inline-item d-flex mb-2 justify-content-between">
                                    <span class="font-weight-bold">Diubah</span>
                                    <span>{{ $item->updated_at->translatedFormat('d-m-Y') }}</span>
                                </li>
                                <li></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-4">Detail Target PBJ</h6>
                            <div class="table-responsive">
                                <table class="table table-hover nowrap">
                                    <thead>
                                        <tr>
                                            <th>Jenis Barang Jasa</th>
                                            <th>Paket</th>
                                            <th>Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($item->details as $detail)
                                            <tr>
                                                <td>{{ $detail->jenis->nama }}
                                                </td>
                                                <td>{{ $detail->paket }}</td>
                                                <td>Rp
                                                    {{ $detail->nilai ? number_format($detail->nilai, 0, '.', '.') : 0 }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
