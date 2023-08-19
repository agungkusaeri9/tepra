@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Penarikan Dana Anggaran</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('penarikan-dana-anggarans.index') }}">Penarikan Dana
                        Anggaran</a>
                </div>
                <div class="breadcrumb-item">Edit Penarikan Dana Anggaran</div>
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
                            <form action="{{ route('penarikan-dana-anggarans.update', $item->id) }}" method="post"
                                class="needs-validation" novalidate="">
                                @csrf
                                @method('patch')
                                <div class="form-group">
                                    <label for="jenis_belanja">Jenis Belanja</label>
                                    <input type="text" class="form-control @error('jenis_belanja') is-invalid @enderror"
                                        required="" name="jenis_belanja"
                                        value="{{ $item->jenis_belanja ?? old('jenis_belanja') }}">
                                    @error('jenis_belanja')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                @foreach ($item->details as $key => $detail)
                                    @if ($detail->triwulan->checkActive() == true)
                                        <div class="row" id="row2">
                                            <div class="col-md-4">
                                                <div class='form-group mb-3'>
                                                    <label for='item_description' class='mb-2'>Pilih Triwulan</label>
                                                    <select name="triwulan_id[]" id="triwulan_id"
                                                        class="form-control @error('triwulan_id') is-invalid @enderror">
                                                        @foreach ($data_triwulan as $triwulan)
                                                            <option @selected($triwulan->id == $detail->triwulan_id)
                                                                value="{{ $triwulan->id }}">
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
                                                        value='{{ $detail->target_belanja }}'>
                                                    @error('target_belanja')
                                                        <div class='invalid-feedback'>
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class='form-group mb-3'>
                                                    <label for='realisasi_belanja' class='mb-2'>Realisasi
                                                        Belanja</label>
                                                    <input type='number' required name='realisasi_belanja[]'
                                                        class='form-control @error('realisasi_belanja') is-invalid @enderror'
                                                        value='{{ $detail->realisasi_belanja }}'>
                                                    @error('realisasi_belanja')
                                                        <div class='invalid-feedback'>
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            @if ($key < 1)
                                                <div class="col-md align-self-end mb-3">
                                                    <button type="button" class="btn btn-block py-2 rowAdd btn-success"><i
                                                            class="fas fa-plus"></i></button>
                                                </div>
                                            @else
                                                <div class="col-md align-self-end mb-3">
                                                    <button type="button"
                                                        class="btn btn-block py-2 rowDelete2 btn-danger"><i
                                                            class="fas fa-minus"></i></button>
                                                </div>
                                            @endif
                                        </div>
                                    @else
                                        <div class="row" id="row2">
                                            <div class="col-md-4">
                                                <div class='form-group mb-3'>
                                                    <label for='item_description' class='mb-2'>Pilih Triwulan</label>
                                                    <select name="triwulan_id[]" id="triwulan_id"
                                                        class="form-control @error('triwulan_id') is-invalid @enderror">
                                                        <option value="{{ $detail->triwulan->id }}">
                                                            {{ $detail->triwulan->nama . ' (' . $detail->triwulan->rentangWaktu() . ')' }}
                                                        </option>
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
                                                        value='{{ $detail->target_belanja }}'>
                                                    @error('target_belanja')
                                                        <div class='invalid-feedback'>
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class='form-group mb-3'>
                                                    <label for='realisasi_belanja' class='mb-2'>Realisasi
                                                        Belanja</label>
                                                    <input type='number' required name='realisasi_belanja[]'
                                                        class='form-control @error('realisasi_belanja') is-invalid @enderror'
                                                        value='{{ $detail->realisasi_belanja }}'>
                                                    @error('realisasi_belanja')
                                                        <div class='invalid-feedback'>
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            @if ($key < 1)
                                                <div class="col-md align-self-end mb-3">
                                                    <button type="button" class="btn btn-block py-2 rowAdd btn-success"><i
                                                            class="fas fa-plus"></i></button>
                                                </div>
                                            @else
                                                <div class="col-md align-self-end mb-3">
                                                    <button type="button" class="btn btn-block py-2 disabled btn-danger"><i
                                                            class="fas fa-minus"></i></button>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                @endforeach
                                <div class="newInput"></div>
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
                                            <label for='target_belanja' class='mb-2'>Target Pendapatan</label>
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
                                            <label for='realisasi_belanja' class='mb-2'>Realisasi Pendapatan</label>
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

            $("body").on("click", ".rowDelete2", function() {
                $(this).parents("#row2").remove();
            })

        })
    </script>
@endpush
