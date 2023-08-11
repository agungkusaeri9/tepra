@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tambah Target PBJ</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('target-pbjs.index') }}">Target PBJ</a>
                </div>
                <div class="breadcrumb-item">Tambah Target PBJ</div>
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
                            <form action="{{ route('target-pbjs.store') }}" method="post" class="needs-validation"
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

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class='form-group mb-3'>
                                            <label for='jenis_barang_jasa_id' class='mb-2'>Pilih Jenis Barang Jasa</label>
                                            <select name="jenis_barang_jasa_id[]" id="jenis_barang_jasa_id"
                                                class="form-control @error('jenis_barang_jasa_id') is-invalid @enderror">
                                                @foreach ($data_jenis_barjas as $barjas)
                                                    <option value="{{ $barjas->id }}">
                                                        {{ $barjas->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('jenis_barang_jasa_id')
                                                <div class='invalid-feedback'>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class='form-group mb-3'>
                                            <label for='paket' class='mb-2'>Paket</label>
                                            <input type='number' name='paket[]' required
                                                class='form-control @error('paket') is-invalid @enderror' value=''>
                                            @error('paket')
                                                <div class='invalid-feedback'>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class='form-group mb-3'>
                                            <label for='nilai' class='mb-2'>Nilai (Rp)</label>
                                            <input type='number' required name='nilai[]'
                                                class='form-control @error('nilai') is-invalid @enderror' value=''>
                                            @error('nilai')
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
                                            <label for='jenis_barang_jasa_id' class='mb-2'>Pilih Jenis Barang Jasa</label>
                                            <select name="jenis_barang_jasa_id[]" id="jenis_barang_jasa_id"
                                                class="form-control @error('jenis_barang_jasa_id') is-invalid @enderror">
                                                @foreach ($data_jenis_barjas as $barjas)
                                                    <option value="{{ $barjas->id }}">
                                                        {{ $barjas->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('jenis_barang_jasa_id')
                                                <div class='invalid-feedback'>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class='form-group mb-3'>
                                            <label for='paket' class='mb-2'>Paket</label>
                                            <input type='number' name='paket[]' required
                                                class='form-control @error('paket') is-invalid @enderror'
                                                value=''>
                                            @error('paket')
                                                <div class='invalid-feedback'>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class='form-group mb-3'>
                                            <label for='nilai' class='mb-2'>Nilai (Rp)</label>
                                            <input type='number' required name='nilai[]'
                                                class='form-control @error('nilai') is-invalid @enderror'
                                                value=''>
                                            @error('nilai')
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
