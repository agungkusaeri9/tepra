@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Rekomendasi Permasalahan Pendapatan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('permasalahan-pendapatans.index') }}">Permasalahan
                        Pendapatan</a>
                </div>
                <div class="breadcrumb-item">Rekomendasi Permasalahan Pendapatan</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('permasalahan-pendapatans.rekomendasi-store', $item->id) }}"
                                method="post" class="needs-validation" novalidate="">
                                @csrf
                                <div class='form-group mb-3'>
                                    <label for='permasalahan' class='mb-2'>Permasalahan</label>
                                    <textarea name='permasalahan' id='permasalahan' cols='30' rows='3'
                                        class='form-control @error('permasalahan') is-invalid @enderror' readonly>{{ $item->permasalahan ?? old('permasalahan') }}</textarea>
                                    @error('permasalahan')
                                        <div class='invalid-feedback'>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class='form-group mb-3'>
                                    <label for='penyebab' class='mb-2'>Penyebab</label>
                                    <textarea name='penyebab' id='penyebab' cols='30' rows='3'
                                        class='form-control @error('penyebab') is-invalid @enderror' readonly>{{ $item->penyebab ?? old('penyebab') }}</textarea>
                                    @error('penyebab')
                                        <div class='invalid-feedback'>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class='form-group mb-3'>
                                    <label for='rekomendasi' class='mb-2'>Rekomendasi</label>
                                    <textarea name='rekomendasi' id='rekomendasi' cols='30' rows='3'
                                        class='form-control @error('rekomendasi') is-invalid @enderror'>{{ $item->rekomendasi ?? old('rekomendasi') }}</textarea>
                                    @error('rekomendasi')
                                        <div class='invalid-feedback'>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button class="btn float-right btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection