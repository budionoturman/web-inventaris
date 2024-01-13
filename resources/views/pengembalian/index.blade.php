@extends('layouts/layout')
@section('container')
    <div class="container-fluid">
        <div class="row">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="col-lg-12 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <div class="d-flex inline justify-content-between">
                            <h5 class="card-title fw-semibold mb-4">Tabel Peminjam</h5>
                            {{-- @can('isAdmin')
                                <button type="button" class="btn btn-outline-secondary m-1">
                                    <a href="/pengembalian/"> Tambah</a>
                                </button>
                            @endcan --}}
                        </div>
                        <div class="table-responsive">
                            <table class="table text-nowrap mb-0 align-middle" id="dataTable">
                                <thead class="text-dark fs-4">
                                    <tr>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">No</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Nama</h6>
                                        </th>

                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">No. Hp</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Barang</h6>
                                        </th>

                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Jumlah Total</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Tgl Pinjam</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Status</h6>
                                        </th>
                                        @can('isKepalaStaff')
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0 text-center">Aksi</h6>
                                            </th>
                                        @endcan
                                        @can('isStaffGudang')
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0 text-center">Aksi</h6>
                                            </th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($peminjamans as $peminjaman)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $peminjaman->user->name }}</td>
                                            <td>{{ $peminjaman->user->no_hp }}</td>
                                            <td> <?php
                                            foreach ($peminjaman->barang as $brg) {
                                                echo $brg->barang_name . '<br>';
                                            }
                                            ?>
                                            </td>
                                            <td>{{ $peminjaman->total }}</td>
                                            <td>{{ $peminjaman->created_at->format('d-M-Y') }}</td>
                                            <td>
                                                <button class="btn btn-danger m-1">{{ $peminjaman->status }}</button>
                                            </td>
                                            @can('isKepalaStaff')
                                                <td class="text-center d-flex inline justify-content-center">
                                                    <a href="/kembalikan/{{ $peminjaman->id }}">
                                                        <button type="button" class="btn btn-success m-1">Kembalikan</button>
                                                    </a>
                                                    {{-- <form action="/pengembalian/{{ $peminjaman->id }}/edit" method="post">
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn btn-outline-danger m-1">kembalikan</button>
                                                </form> --}}
                                                </td>
                                            @endcan
                                            @can('isStaffGudang')
                                                <td class="text-center d-flex inline justify-content-center">
                                                    <a href="/kembalikan/{{ $peminjaman->id }}">
                                                        <button type="button" class="btn btn-success m-1">Kembalikan</button>
                                                    </a>
                                                    {{-- <form action="/pengembalian/{{ $peminjaman->id }}/edit" method="post">
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn btn-outline-danger m-1">kembalikan</button>
                                                </form> --}}
                                                </td>
                                            @endcan
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
