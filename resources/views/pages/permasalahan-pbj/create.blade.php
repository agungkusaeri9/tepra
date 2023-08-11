@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tambah Permasalahan Pendapatan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('permasalahan-pbjs.index') }}">Permasalahan
                        Pendapatan</a>
                </div>
                <div class="breadcrumb-item">Tambah Permasalahan Pendapatan</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('permasalahan-pbjs.store') }}" method="post" class="needs-validation"
                                novalidate="">
                                @csrf
                                <div class='form-group mb-3'>
                                    <label for='triwulan_id' class='mb-2'>Pilih Triwulan</label>
                                    <select name="triwulan_id" id="triwulan_id"
                                        class="form-control @error('triwulan_id') is-invalid @enderror">
                                        <option value="">Pilih Triwulan</option>
                                        @foreach ($data_triwulan as $triwulan)
                                            <option value="{{ $triwulan->id }}">
                                                {{ $triwulan->nama . ' (' . $triwulan->rentangWaktu() . ')' }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('triwulan_id')
                                        <div class='invalid-feedback'>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class='form-group mb-3'>
                                    <label for='permasalahan' class='mb-2'>Permasalahan</label>
                                    <textarea name='permasalahan' id='permasalahan' cols='30' rows='3'
                                        class='form-control @error('permasalahan') is-invalid @enderror'>{{ old('permasalahan') }}</textarea>
                                    @error('permasalahan')
                                        <div class='invalid-feedback'>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class='form-group mb-3'>
                                    <label for='penyebab' class='mb-2'>Penyebab</label>
                                    <textarea name='penyebab' id='penyebab' cols='30' rows='3'
                                        class='form-control @error('penyebab') is-invalid @enderror'>{{ old('penyebab') }}</textarea>
                                    @error('penyebab')
                                        <div class='invalid-feedback'>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button class="btn float-right btn-primary">Tambah</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
