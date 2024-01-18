@extends('layouts/layout')
@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body p-4">

                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="d-flex inline justify-content-between">
                            <h5 class="card-title fw-semibold mb-4">Tabel Data Barang Rusak</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table text-nowrap mb-0 align-middle" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Barang</th>
                                        <th>Kode Barang</th>
                                        <th>Kondisi</th>
                                        @can('isStaffGudang')
                                            <th>Aksi</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($barangs as $barang)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $barang->barang_name }}</td>
                                            <td>{{ $barang->barang_code }}</td>
                                            <td>{{ $barang->kondisi }}</td>
                                            @can('isStaffGudang')
                                                <td class="d-flex inline">
                                                    <a href="/kondisi-barangs/{{ $barang->id }}/perbaikan">
                                                        <button type="button" class="btn btn-outline-success m-1"><i
                                                                class="fa-solid fa-pen-to-square"></i> Sudah Diperbaiki</button>
                                                    </a>
                                                    <a href="/kondisi-barangs/{{ $barang->id }}/tidak-perbaikan">
                                                        <button type="button" class="btn btn-outline-warning m-1"><i
                                                                class="fa-solid fa-pen-to-square"></i> Tidak dapat
                                                            Diperbaiki</button>
                                                    </a>
                                                </td>
                                            @endcan
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
