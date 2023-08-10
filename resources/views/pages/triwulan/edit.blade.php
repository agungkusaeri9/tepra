@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Triwulan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('triwulans.index') }}">Triwulan</a></div>
                <div class="breadcrumb-item">Edit Triwulan</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('triwulans.update', $item->id) }}" method="post"
                                class="needs-validation" novalidate="">
                                @csrf
                                @method('patch')
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                        required="" name="nama" value="{{ $item->nama ?? old('nama') }}">
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class='form-group mb-3'>
                                    <label for='bulan_awal' class='mb-2'>Bulan Awal</label>
                                    <select name="bulan_awal" id="bulan_awal"
                                        class="form-control @error('bulan_awal') is-invalid @enderror">
                                        <option value="">Pilih Bulan Awal</option>
                                        @foreach ($data_bulan as $bulan)
                                            <option @selected($bulan['nomor'] == $item->bulan_awal) value="{{ $bulan['nomor'] }}">
                                                {{ $bulan['nama'] }}</option>
                                        @endforeach
                                    </select>
                                    @error('bulan_awal')
                                        <div class='invalid-feedback'>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class='form-group mb-3'>
                                    <label for='tahun_awal' class='mb-2'>Tahun Awal</label>
                                    <input type='number' name='tahun_awal'
                                        class='form-control @error('tahun_awal') is-invalid @enderror'
                                        value='{{ $item->tahun_awal ?? old('tahun_awal') }}'>
                                    @error('tahun_awal')
                                        <div class='invalid-feedback'>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class='form-group mb-3'>
                                    <label for='bulan_akhir' class='mb-2'>Bulan Awal</label>
                                    <select name="bulan_akhir" id="bulan_akhir"
                                        class="form-control @error('bulan_akhir') is-invalid @enderror">
                                        <option value="">Pilih Bulan Akhir</option>
                                        @foreach ($data_bulan as $bulan)
                                            <option @selected($bulan['nomor'] == $item->bulan_akhir) value="{{ $bulan['nomor'] }}">
                                                {{ $bulan['nama'] }}</option>
                                        @endforeach
                                    </select>
                                    @error('bulan_akhir')
                                        <div class='invalid-feedback'>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class='form-group mb-3'>
                                    <label for='tahun_akhir' class='mb-2'>Tahun Akhir</label>
                                    <input type='number' name='tahun_akhir'
                                        class='form-control @error('tahun_akhir') is-invalid @enderror'
                                        value='{{ $item->tahun_akhir ?? old('tahun_akhir') }}'>
                                    @error('tahun_akhir')
                                        <div class='invalid-feedback'>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button class="btn float-right btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
