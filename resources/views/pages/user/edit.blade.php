@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit User</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('users.index') }}">User</a></div>
                <div class="breadcrumb-item">Edit User</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('users.update', $item->id) }}" method="post" class="needs-validation"
                                novalidate="" enctype="multipart/form-data">
                                @csrf
                                @method('patch')
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        required="" name="name" value="{{ $item->name ?? old('name') }}">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control @error('username') is-invalid @enderror"
                                        required="" name="username" value="{{ $item->username ?? old('username') }}">
                                    @error('username')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror"
                                        required="" name="email" value="{{ $item->email ?? old('email') }}">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Password <span class="text-gray">(Kosongkan jik tidak ingin merubah
                                                password)</span></label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            name="password">
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Konfirmasi Password <span class="text-gray">(Kosongkan jik tidak ingin
                                                merubah password)</span></label>
                                        <input type="password"
                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                            name="password_confirmation">
                                        @error('password_confirmation')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Role</label>
                                    <select name="role" id="role" class="form-control" required="">
                                        <option value="" selected disabled>Pilih Role</option>
                                        <option @if ($item->role == 'operator') selected @endif value="operator">Operator
                                        </option>
                                        <option @if ($item->role == 'skpd') selected @endif value="skpd">SKPD
                                        </option>
                                        <option @if ($item->role == 'tim tepra') selected @endif value="tim tepra">Tim
                                            Tepra
                                        </option>

                                    </select>
                                    @error('role')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-1">
                                        <div class="text-center">
                                            <label>Avatar</label><br>
                                            <img src="{{ $item->avatar() }}" class="img-fluid rounded-circle"
                                                style="max-height: 80px" alt="">
                                        </div>
                                    </div>
                                    <div class="col-md-11 align-self-center">
                                        <input type="file" name="avatar" class="form-control">
                                        @error('avatar')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
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
