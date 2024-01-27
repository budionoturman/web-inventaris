@extends('layouts/layout')
@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body p-4">

                        {{-- @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif --}}

                        <div class="d-flex inline justify-content-between">
                            <h5 class="card-title fw-semibold mb-4">Saran Pengadaan Barang</h5>
                            @canany(['isKepalaStaff', 'isStaffGudang'])
                                <button type="button" class="btn btn-outline-secondary m-1">
                                    <a href="/pengadaans/create">Tambah</a>
                                </button>
                            @endcanany
                        </div>

                        <div class="table-responsive">
                            <table class="table text-nowrap mb-0 align-middle" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Barang</th>
                                        <th>Kode Barang</th>
                                        <th>Kondisi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($barangs as $barang)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $barang->barang_name }}</td>
                                            <td>{{ $barang->barang_code }}</td>
                                            <td>{{ $barang->kondisi }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex inline justify-content-between">
                            <h5 class="card-title fw-semibold mb-4">Pengadaan Barang</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table text-nowrap mb-0 align-middle" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>No Pengadaan</th>
                                        <th>Barang</th>
                                        <th>Tanggal Pengajuan</th>
                                        <th>Status</th>
                                        @can('isKepalaSekolah')
                                            <th>Aksi</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pengadaans as $pengadaan)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $pengadaan->no_surat }}</td>
                                            <td><?php
                                            foreach ($pengadaan->barang as $brg) {
                                                echo $brg->barang_name . '<br>';
                                            }
                                            ?>
                                            </td>
                                            <td>{{ Carbon\Carbon::parse($pengadaan->tgl_pengajuan)->format('d-M-Y') }}</td>
                                            <td>{{ $pengadaan->status }}</td>
                                            @can('isKepalaSekolah')
                                                <td class="d-flex inline">
                                                    <a href="/pengadaans/{{ $pengadaan->id }}">
                                                        <button type="button" class="btn btn-outline-secondary m-1"><i
                                                                class="fa-solid fa-eye"></i> Lihat</button>
                                                    </a>
                                                    @if ($pengadaan->status == 'pengajuan')
                                                        <form action="/pengadaans/setujui/{{ $pengadaan->id }}" method="post">
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn btn-outline-success m-1">Setujui</button>
                                                        </form>
                                                        <form action="/pengadaans/tolak/{{ $pengadaan->id }}" method="post">
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn btn-outline-danger m-1">Tolak</button>
                                                        </form>
                                                    @endif
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
