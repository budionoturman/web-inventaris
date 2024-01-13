@extends('layouts/layout')
@section('container')
    <div class="container-fluid">
        <div class="row">
            @if (session()->has('success'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="col-lg-12 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <div class="d-flex inline justify-content-between">
                            <h5 class="card-title fw-semibold mb-4">Tabel History</h5>
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
                                            <h6 class="fw-semibold mb-0">Tgl Kembali</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Denda</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Status</h6>
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($peminjaman as $pjm)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $pjm->user->name }}</td>
                                            <td>{{ $pjm->user->no_hp }}</td>
                                            <td><?php
                                            foreach ($pjm->barang as $brg) {
                                                echo $brg->barang_name . '<br>';
                                            }
                                            ?></td>
                                            <td>{{ $pjm->total }}</td>
                                            <td>{{ $pjm->tgl_pinjam }}</td>
                                            <td>{{ $pjm->tgl_kembali }}</td>
                                            <td>{{ $pjm->denda }}</td>
                                            <td>
                                                <button class="btn btn-danger m-1">{{ $pjm->status }}</button>
                                            </td>

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
