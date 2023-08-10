@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Jenis Barang Jasa</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('jenis-barang-jasa.index') }}">Jenis Barang Jasa</a>
                </div>
                <div class="breadcrumb-item">Edit Jenis Barang Jasa</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('jenis-barang-jasa.update', $item->id) }}" method="post"
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
