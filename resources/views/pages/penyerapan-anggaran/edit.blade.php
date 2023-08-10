@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Penyerapan Anggaran</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('penyerapan-anggarans.index') }}">Penyerapan
                        Anggaran</a>
                </div>
                <div class="breadcrumb-item">Edit Penyerapan Anggaran</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('penyerapan-anggarans.update', $item->id) }}" method="post"
                                class="needs-validation" novalidate="">
                                @csrf
                                @method('patch')
                                <div class="form-group">
                                    <label>Urusan Pemerintahan</label>
                                    <input type="text"
                                        class="form-control @error('urusan_pemerintahan') is-invalid @enderror"
                                        required="" name="urusan_pemerintahan"
                                        value="{{ $item->urusan_pemerintahan ?? old('urusan_pemerintahan') }}">
                                    @error('urusan_pemerintahan')
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
