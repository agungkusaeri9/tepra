@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Laporan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Laporan</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form action="{{ route('laporan.export-excel') }}" method="post">
                            <div class="card-body row">
                                @csrf
                                <div class="col-md-4">
                                    <div class='form-group mb-3'>
                                        <label for='user_id' class='mb-2'>Pilih User SKPD</label>
                                        <select name="user_id" id="user_id" class="form-control">
                                            <option value="">Pilih User</option>
                                            @foreach ($data_user as $user)
                                                <option value="{{ $user->id }}">
                                                    {{ $user->name . ' - ' . $user->nip }}</option>
                                            @endforeach
                                        </select>
                                        @error('user_id')
                                            <div class='invalid-feedback'>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 align-self-center mt-2">
                                    <button class="btn btn-info py-2"><i class="fas fa-file-excel"></i> Export Data</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    @include('layouts.partials.sweetalert')
@endpush
