@extends('layouts/layout')
@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <div class="d-flex inline justify-content-between">
                            <h5 class="card-title fw-semibold mb-4">Tabel Request Barang</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table text-nowrap mb-0 align-middle" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Pegawai</th>
                                        <th>Kategori</th>
                                        <th>Nama Barang</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($requestBarangs as $barang)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $barang->user->name }}</td>
                                            <td>{{ $barang->kategori->kategori_name }}</td>
                                            <td>{{ $barang->barang_name }}</td>
                                            <td>{{ $barang->status }}</td>
                                            <td class="d-flex inline">
                                                @canany(['isKepalaStaff'])
                                                    <a href="/request-barang-masuk/{{ $barang->id }}/edit">
                                                        <button type="button" class="btn btn-outline-warning m-1"><i
                                                                class="fa-solid fa-pen-to-square"></i></button>
                                                    </a>
                                                    <form action="/request-barang-masuk/{{ $barang->id }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-outline-danger m-1"><i
                                                                class="fa-solid fa-trash-can"></i></button>
                                                    </form>
                                                @endcanany
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
    </div>
@endsection
