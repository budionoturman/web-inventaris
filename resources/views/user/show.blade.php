@extends('layouts/layout')
@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title fw-semibold mb-4">Profile</h4>
                        <h5 class="card-title">{{ $user->name }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">NIP : {{ $user->nip }}</h6>
                        <h6 class="card-subtitle mb-2 text-muted">No HP : {{ $user->no_hp }}</h6>
                        <p class="card-text">Role : {{ $user->role->role_name }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <div class="d-flex inline justify-content-between">
                            <h5 class="card-title fw-semibold mb-4">Tabel History : {{ $user->name }}</h5>
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
