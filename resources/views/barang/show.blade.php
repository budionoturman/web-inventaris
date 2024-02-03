@extends('layouts/layout')
@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body p-4">

                        <div class=" row justify-content-between">
                            <div class="col">
                                <h5 class="card-title fw-semibold mb-4">Tabel History Peminjam Barang</h5>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table text-nowrap mb-0 align-middle" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Peminjam</th>
                                        <th>NIP</th>
                                        <th>No. HP</th>
                                        <th>Tanggal Pinjam</th>
                                        <th>Tanggal Kembali</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($peminjamans as $peminjaman)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $peminjaman->peminjaman->user->name }}</td>
                                            <td>{{ $peminjaman->peminjaman->user->nip }}</td>
                                            <td>{{ $peminjaman->peminjaman->user->no_hp }}</td>
                                            <td>{{ $peminjaman->peminjaman->tgl_pinjam }}</td>
                                            <td>{{ $peminjaman->peminjaman->tgl_kembali }}</td>
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
@endsection
