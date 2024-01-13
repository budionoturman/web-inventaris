@extends('layouts/layout')
@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <div class="d-flex inline justify-content-between">
                            <h5 class="card-title fw-semibold mb-4">Tabel Peminjam</h5>
                            @can('isKepalaStaff')
                                <button type="button" class="btn btn-outline-secondary m-1">
                                    <a href="/peminjams/create"> Tambah</a>
                                </button>
                            @endcan
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
                                            <h6 class="fw-semibold mb-0">Tgl Pinjam</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Tgl Kembali</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Status</h6>
                                        </th>
                                        @canany(['isKepalaStaff', 'isStaffGudang'])
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0 text-center">Aksi</h6>
                                            </th>
                                        @endcanany
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
                                            <td>{{ $peminjaman->tgl_pinjam }}</td>
                                            <td>{{ $peminjaman->tgl_kembali }}</td>
                                            <td>{{ $peminjaman->status }}</td>
                                            <td>
                                                @if ($peminjaman->status === 'belum kembali')
                                                    <button class="btn btn-danger m-1">{{ $peminjaman->status }}</button>
                                                @elseif($peminjaman->status === 'proses')
                                                    <a href="/proses/{{ $peminjaman->id }}">
                                                        <button type="button"
                                                            class="btn btn-success m-1">{{ $peminjaman->status }}</button>
                                                    </a>
                                                @else
                                                    <button class="btn btn-success m-1">{{ $peminjaman->status }}</button>
                                                @endif
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
