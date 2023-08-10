@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tambah Penarikan Dana Anggaran</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('penarikan-dana-anggarans.index') }}">Penarikan Dana
                        Anggaran</a>
                </div>
                <div class="breadcrumb-item">Tambah Penarikan Dana Anggaran</div>
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
                            <form action="{{ route('penarikan-dana-anggarans.store') }}" method="post"
                                class="needs-validation" novalidate="">
                                @csrf
                                <div class="form-group">
                                    <label for="jenis_belanja">Jenis Belanja</label>
                                    <input type="text" class="form-control @error('jenis_belanja') is-invalid @enderror"
                                        required="" name="jenis_belanja" value="{{ old('jenis_belanja') }}">
                                    @error('jenis_belanja')
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
                                            <label for='target_belanja' class='mb-2'>Target Belanja</label>
                                            <input type='number' name='target_belanja[]' required
                                                class='form-control @error('target_belanja') is-invalid @enderror'
                                                value=''>
                                            @error('target_belanja')
                                                <div class='invalid-feedback'>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class='form-group mb-3'>
                                            <label for='realisasi_belanja' class='mb-2'>Realisasi belanja</label>
                                            <input type='number' required name='realisasi_belanja[]'
                                                class='form-control @error('realisasi_belanja') is-invalid @enderror'
                                                value=''>
                                            @error('realisasi_belanja')
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
                                            <label for='target_belanja' class='mb-2'>Target Belanja</label>
                                            <input type='number' name='target_belanja[]' required
                                                class='form-control @error('target_belanja') is-invalid @enderror'
                                                value=''>
                                            @error('target_belanja')
                                                <div class='invalid-feedback'>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class='form-group mb-3'>
                                            <label for='realisasi_belanja' class='mb-2'>Realisasi belanja</label>
                                            <input type='number' required name='realisasi_belanja[]'
                                                class='form-control @error('realisasi_belanja') is-invalid @enderror'
                                                value=''>
                                            @error('realisasi_belanja')
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
