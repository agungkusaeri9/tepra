@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Detail Pendapatan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('pendapatans.index') }}">Pendapatan</a>
                </div>
                <div class="breadcrumb-item">Detail Pendapatan</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-4">Pendapatan</h6>
                            <ul class="list-inline">
                                <li class="list-inline-item d-flex mb-2 justify-content-between">
                                    <span class="font-weight-bold">Jenis</span>
                                    <span>{{ $item->jenis_pendapatan }}</span>
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
                            <h6 class="mb-4">Detail Pendapatan</h6>
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>Triwulan</th>
                                        <th>Target</th>
                                        <th>Realisasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($item->details as $detail)
                                        <tr>
                                            <td>{{ $detail->triwulan->nama . ' (' . $detail->triwulan->rentangWaktu() . ')' }}
                                            </td>
                                            <td>Rp {{ number_format($detail->target_pendapatan, 0, '.', '.') }}</td>
                                            <td>Rp {{ number_format($detail->realisasi_pendapatan, 0, '.', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
