@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data Permasalahan Pendapatan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Data Permasalahan Pendapatan</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            @if (auth()->user()->role === 'skpd')
                                <a href="{{ route('permasalahan-pendapatans.create') }}"
                                    class="btn btn-sm btn-primary mb-3"><i class="fas fa-plus"></i> Tambah Data</a>
                            @endif
                            <div class="table-responsive">
                                <table class="table table-striped table-hover nowrap" id="dTable">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>SKPD</th>
                                            <th>Permasalahan</th>
                                            <th>Penyebab</th>
                                            <th>Rekomendasi</th>
                                            <th>Tim Tepra</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($items as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->user->name }}</td>
                                                <td>{{ $item->permasalahan }}</td>
                                                <td>{{ $item->penyebab }}</td>
                                                <td>
                                                    {{ $item->rekomendasi ?? 'Tidak Ada' }}
                                                </td>
                                                <td>{{ $item->timTepra->name ?? 'Tidak Ada' }}</td>
                                                <td>
                                                    @if (auth()->user()->role === 'tim tepra')
                                                        @if (!$item->rekomendasi && !$item->timTepra)
                                                            <a href="{{ route('permasalahan-pendapatans.rekomendasi', $item->id) }}"
                                                                class="btn btn-sm btn-primary"><i class="fas fa-plus"></i>
                                                                Rekomendasi</a>
                                                        @else
                                                            <a href="javascript:void(0)"
                                                                class="btn btn-sm btn-primary disabled"><i
                                                                    class="fas fa-plus"></i>
                                                                Rekomendasi</a>
                                                        @endif
                                                    @else
                                                        <a href="{{ route('permasalahan-pendapatans.edit', $item->id) }}"
                                                            class="btn btn-sm btn-info"><i class="fas fa-edit"></i> Edit</a>
                                                        <form action="" method="post" class="d-inline"
                                                            id="formDelete">
                                                            @csrf
                                                            @method('delete')
                                                            <button
                                                                data-action="{{ route('permasalahan-pendapatans.destroy', $item->id) }}"
                                                                class="btn btn-sm btn-danger btnDelete"><i
                                                                    class="fas fa-trash"></i>
                                                                Hapus</button>
                                                        </form>
                                                    @endif

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/sweetalert2/sweetalert2.all.min.js') }}">
    <link rel="stylesheet" href="{{ asset('assets/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
@endpush
@push('scripts')
    <script src="{{ asset('assets/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        $(function() {
            $('#dTable').DataTable();
            $('body').on('click', '.btnDelete', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let action = $(this).data('action');
                        $('#formDelete').attr('action', action);
                        $('#formDelete').submit();
                    }
                })
            })
        })
    </script>
    @include('layouts.partials.sweetalert')
@endpush
