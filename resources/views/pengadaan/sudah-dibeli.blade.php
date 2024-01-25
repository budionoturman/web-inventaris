@extends('layouts/layout')
@section('container')
    <div class="container-fluid">
        <div class="row">
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
                                    <th>Tanggal Pengajuan</th>
                                    <th>Tanggal Pembelian</th>
                                    <th>Status</th>
                                    <th>Kwitansi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengadaans as $pengadaan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pengadaan->no_surat }}</td>
                                        <td>{{ Carbon\Carbon::parse($pengadaan->tgl_pengajuan)->format('d-M-Y') }}</td>
                                        <td>{{ Carbon\Carbon::parse($pengadaan->kwitansi->tgl_beli)->format('d-M-Y') }}</td>
                                        <td>{{ $pengadaan->status }}</td>
                                        <td>
                                            <a href="{{ asset('kwitansi') }}/{{ $pengadaan->kwitansi->path }}"
                                                target="_blank">
                                                <button type="button" class="btn btn-outline-success m-1"><i
                                                        class="fa-solid fa-eye"></i> Lihat</button>
                                            </a>
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
@endsection
