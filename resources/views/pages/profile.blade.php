@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Profile</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Profile</div>
            </div>
        </div>
        <div class="section-body">


            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <form method="post" class="needs-validation" action="{{ route('profile.update') }}" novalidate=""
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-header">
                                <h4>Edit Profile</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label>Nama</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            value="{{ auth()->user()->name ?? '-' }}" required="" name="name">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Username</label>
                                        <input type="text" class="form-control @error('username') is-invalid @enderror"
                                            value="{{ auth()->user()->username ?? '-' }}" required="" readonly
                                            name="username">
                                        @error('username')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label>NIP</label>
                                        <input type="text" class="form-control @error('nip') is-invalid @enderror"
                                            value="{{ auth()->user()->nip ?? '-' }}" required="" name="nip" readonly>
                                        @error('nip')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            value="{{ auth()->user()->email ?? '-' }}" required="" name="email"
                                            readonly>
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label>Nama Kepala SKPD</label>
                                        <input type="text"
                                            class="form-control @error('nama_kepala_skpd') is-invalid @enderror"
                                            value="{{ auth()->user()->nama_kepala_skpd ?? '-' }}" required=""
                                            name="nama_kepala_skpd" readonly>
                                        @error('nama_kepala_skpd')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Role</label>
                                        <input type="text" class="form-control @error('role') is-invalid @enderror"
                                            value="{{ auth()->user()->role ?? '-' }}" required="" name="role"
                                            readonly>
                                        @error('role')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label for='alamat' class='mb-2'>Alamat</label>
                                        <textarea name='alamat' id='alamat' cols='30' rows='3'
                                            class='form-control @error('alamat') is-invalid @enderror'>{{ auth()->user()->alamat ?? old('alamat') }}</textarea>
                                        @error('alamat')
                                            <div class='invalid-feedback'>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Avatar</label>
                                        <input type="file" name="avatar"
                                            class="form-control @error('avatar') is-invalid @enderror">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/sweetalert2/sweetalert2.all.min.js') }}">
    <link rel="stylesheet" href="{{ asset('assets/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
@endpush
@push('scripts')
    <script src="{{ asset('assets/sweetalert2/sweetalert2.min.js') }}"></script>
    @include('layouts.partials.sweetalert')
@endpush
