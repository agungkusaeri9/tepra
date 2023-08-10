@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Penanganan Covid 19</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('pendanaan-penanganan-covid19.index') }}">Penyerapan
                        Anggaran</a>
                </div>
                <div class="breadcrumb-item">Edit Penanganan Covid 19</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('pendanaan-penanganan-covid19.update', $item->id) }}" method="post"
                                class="needs-validation" novalidate="">
                                @csrf
                                @method('patch')
                                <div class="form-group">
                                    <label>Fokus</label>
                                    <input type="text" class="form-control @error('fokus') is-invalid @enderror"
                                        required="" name="fokus" value="{{ $item->fokus ?? old('fokus') }}">
                                    @error('fokus')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Program</label>
                                    <input type="text" class="form-control @error('program') is-invalid @enderror"
                                        required="" name="program" value="{{ $item->program ?? old('program') }}">
                                    @error('program')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class='form-group mb-3'>
                                    <label for='target' class='mb-2'>Target (Rp)</label>
                                    <input type='number' name='target'
                                        class='form-control @error('target') is-invalid @enderror'
                                        value='{{ $item->target ?? old('target') }}'>
                                    @error('target')
                                        <div class='invalid-feedback'>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class='form-group mb-3'>
                                    <label for='realisasi' class='mb-2'>Realisasi (Rp)</label>
                                    <input type='text' name='realisasi'
                                        class='form-control @error('realisasi') is-invalid @enderror'
                                        value='{{ $item->realisasi ?? old('realisasi') }}'>
                                    @error('realisasi')
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
