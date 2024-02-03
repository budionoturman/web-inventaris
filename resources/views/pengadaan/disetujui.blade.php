@extends('layouts/layout')
@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        {{-- @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif --}}
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
                                        @canany(['isKepalaSekolah', 'isKepalaStaff'])
                                            <th>Aksi</th>
                                        @endcanany
                                        @canany(['isKepalaStaff'])
                                            <th>Sudah Dibeli?</th>
                                        @endcanany
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pengadaans as $pengadaan)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $pengadaan->no_surat }}</td>
                                            <td>
                                                @if ($pengadaan->pengadaan_detail[0]->barang_id != null)
                                                    @foreach ($pengadaan->barang as $brg)
                                                        {{ $brg->barang_name }} <br>
                                                    @endforeach
                                                @endif

                                                @if ($pengadaan->pengadaan_detail[0]->barang_id == null)
                                                    @foreach ($pengadaan->pengadaan_detail as $brg)
                                                        {{ $brg->barang_name }} <br>
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>{{ Carbon\Carbon::parse($pengadaan->tgl_pengajuan)->format('d-M-Y') }}</td>
                                            <td>{{ $pengadaan->status }}</td>
                                            @canany(['isKepalaSekolah', 'isKepalaStaff'])
                                                <td class="d-flex inline">
                                                    <a href="/pengadaans/{{ $pengadaan->id }}">
                                                        <button type="button" class="btn btn-outline-secondary m-1"><i
                                                                class="fa-solid fa-eye"></i> Lihat</button>
                                                    </a>
                                                    @if ($pengadaan->status == 'disetujui')
                                                        <a href="/pengadaans/cetak/{{ $pengadaan->id }}" target="_blank">
                                                            <button type="button" class="btn btn-outline-success m-1"><i
                                                                    class="fa-solid fa-eye"></i> Cetak</button>
                                                        </a>
                                                    @endif
                                                </td>
                                            @endcanany
                                            @canany(['isKepalaStaff'])
                                                <td>
                                                    <a href="/pengadaan/upload-kwitansi/{{ $pengadaan->id }}">
                                                        <button type="button" class="btn btn-outline-secondary m-1"><i
                                                                class="fa-solid fa-edit"></i> Ya</button>
                                                    </a>
                                                </td>
                                            @endcanany
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
