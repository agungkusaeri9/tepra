@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tambah Pendapatan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('pendapatans.index') }}">Pendapatan</a>
                </div>
                <div class="breadcrumb-item">Tambah Pendapatan</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                @if ($errors->any())
                    <div class="col-md-12">
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('pendapatans.store') }}" method="post" class="needs-validation"
                                novalidate="">
                                @csrf
                                <div class="form-group">
                                    <label for="jenis_pendapapatan">Jenis Pendapatan</label>
                                    <input type="text"
                                        class="form-control @error('jenis_pendapatan') is-invalid @enderror" required=""
                                        name="jenis_pendapatan" value="{{ old('jenis_pendapatan') }}">
                                    @error('jenis_pendapatan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class='form-group mb-3'>
                                            <label for='item_description' class='mb-2'>Pilih Triwulan</label>
                                            <select name="triwulan_id[]" id="triwulan_id"
                                                class="form-control @error('triwulan_id') is-invalid @enderror">
                                                @foreach ($data_triwulan as $triwulan)
                                                    <option value="{{ $triwulan->id }}">
                                                        {{ $triwulan->nama . ' (' . $triwulan->rentangWaktu() . ')' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('item_description')
                                                <div class='invalid-feedback'>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class='form-group mb-3'>
                                            <label for='target_pendapatan' class='mb-2'>Target Pendapatan</label>
                                            <input type='number' name='target_pendapatan[]' required
                                                class='form-control @error('target_pendapatan') is-invalid @enderror'
                                                value=''>
                                            @error('target_pendapatan')
                                                <div class='invalid-feedback'>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class='form-group mb-3'>
                                            <label for='realisasi_pendapatan' class='mb-2'>Realisasi Pendapatan</label>
                                            <input type='number' required name='realisasi_pendapatan[]'
                                                class='form-control @error('realisasi_pendapatan') is-invalid @enderror'
                                                value=''>
                                            @error('realisasi_pendapatan')
                                                <div class='invalid-feedback'>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md align-self-end mb-3">
                                        <button type="button" class="btn btn-block py-2 rowAdd btn-success"><i
                                                class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="newInput"></div>
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
@push('scripts')
    <script>
        $(function() {
            $(".rowAdd").click(function() {
                let newRow = `
                <div class="row" id="row">
                    <div class="col-md-4">
                                        <div class='form-group mb-3'>
                                            <label for='item_description' class='mb-2'>Pilih Triwulan</label>
                                            <select name="triwulan_id[]" id="triwulan_id"
                                                class="form-control @error('triwulan_id') is-invalid @enderror">
                                                @foreach ($data_triwulan as $triwulan)
                                                    <option value="{{ $triwulan->id }}">
                                                        {{ $triwulan->nama . ' (' . $triwulan->rentangWaktu() . ')' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('item_description')
                                                <div class='invalid-feedback'>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class='form-group mb-3'>
                                            <label for='target_pendapatan' class='mb-2'>Target Pendapatan</label>
                                            <input type='number' name='target_pendapatan[]' required
                                                class='form-control @error('target_pendapatan') is-invalid @enderror'
                                                value=''>
                                            @error('target_pendapatan')
                                                <div class='invalid-feedback'>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class='form-group mb-3'>
                                            <label for='realisasi_pendapatan' class='mb-2'>Realisasi Pendapatan</label>
                                            <input type='number' required name='realisasi_pendapatan[]'
                                                class='form-control @error('realisasi_pendapatan') is-invalid @enderror'
                                                value=''>
                                            @error('realisasi_pendapatan')
                                                <div class='invalid-feedback'>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                    <div class="col-md align-self-end mb-3">
                        <button type="button" class="btn btn-block py-2 rowDelete btn-danger"><i
                                class="fas fa-minus"></i></button>
                    </div>
                </div>
            `;
                $('.newInput').append(newRow);
            });

            $("body").on("click", ".rowDelete", function() {
                $(this).parents("#row").remove();
            })

        })
    </script>
@endpush
