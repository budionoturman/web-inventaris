@extends('layouts/layout')
@section('container')
    <div class="container-fluid">
        <div class="row">
            {{-- @if (session()->has('success'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif --}}
            <div class="col-lg-12 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <div class="d-flex inline justify-content-between">
                            <h5 class="card-title fw-semibold mb-4">Tabel History</h5>
                            @can('isStaffGudang')
                                <button type="button" class="btn btn-outline-secondary m-1" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    Cetak
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
                                            <h6 class="fw-semibold mb-0">Denda</h6>
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($peminjaman as $pjm)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $pjm->user->name }}</td>
                                            <td>{{ $pjm->user->no_hp }}</td>
                                            <td>
                                                <?php
                                                foreach ($pjm->barang as $brg) {
                                                    echo $brg->barang_name . ' (' . $brg->pivot->kondisi . ')' . '<br>';
                                                }
                                                ?>
                                            </td>
                                            <td>{{ Carbon\Carbon::parse($pjm->tgl_pinjam)->format('d-M-Y') }}</td>
                                            <td>{{ Carbon\Carbon::parse($pjm->tgl_kembali)->format('d-M-Y') }}</td>
                                            <td>
                                                <a href="/history/preview/{{ $pjm->id }}">
                                                    <button type="button" class="btn btn-success m-1">Lihat</button>
                                                </a>
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
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/peminjaman/history" method="get">
                    {{-- @csrf --}}
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Masukan Periode</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="tgl_from" class="form-label">Dari Tanggal</label>
                            <input type="date" class="form-control" name="tgl_from" required>
                        </div>
                        <div class="mb-3">
                            <label for="tgl_to" class="form-label">Sampai Tanggal</label>
                            <input type="date" class="form-control" name="tgl_to" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Cetak</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
