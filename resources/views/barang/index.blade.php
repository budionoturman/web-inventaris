@extends('layouts/layout')
@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body p-4">

                        {{-- @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong></strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif --}}

                        <div class=" row justify-content-between">
                            <div class="col">
                                <h5 class="card-title fw-semibold mb-4">Tabel Data Barang</h5>
                            </div>
                            <div class="col text-end">
                                @can('isStaffGudang')
                                    <button type="button" class="btn btn-outline-secondary m-1">
                                        <a href="/barangs/create">Tambah</a>
                                    </button>
                                @endcan
                                <button type="button" class="btn btn-outline-secondary m-1" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal"> Cetak
                                    {{-- <a href="/barangs-cetak" target="_blank">Cetak</a> --}}
                                </button>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table text-nowrap mb-0 align-middle" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Barang</th>
                                        <th>Kode Barang</th>
                                        <th>status</th>
                                        <th>Kondisi</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Kategori</th>
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
                                            <td>{{ $barang->status }}</td>
                                            <td>{{ $barang->kondisi }}</td>
                                            <td>{{ Carbon\Carbon::parse($barang->tgl_masuk)->format('d-M-Y') }}</td>
                                            <td>{{ $barang->kategori->kategori_name }}</td>
                                            @can('isStaffGudang')
                                                <td class="d-flex inline">
                                                    <a href="/barangs/{{ $barang->id }}/edit">
                                                        <button type="button" class="btn btn-outline-warning m-1"><i
                                                                class="fa-solid fa-pen-to-square"></i></button>
                                                    </a>
                                                    <form action="/barangs/{{ $barang->id }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-outline-danger m-1"><i
                                                                class="fa-solid fa-trash-can"></i></button>
                                                    </form>
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

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="/barangs-cetak" method="get">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Cetak Barang</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="" class="form-label">Pilih Jurusan</label>
                        <select class="form-control" name="jurusan_id" id="jurusan_id">
                            <option value="">Semua Jurusan</option>
                            @foreach ($jurusans as $jurusan)
                                <option value="{{ $jurusan->id }}">{{ $jurusan->jurusan_name }}</option>
                            @endforeach
                        </select>
                        <label for="" class="form-label">Pilih Kategori</label>
                        <select class="form-control" name="kategori_id" id="kategori_id">
                            <option value="">Semua Kategori</option>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->kategori_name }}</option>
                            @endforeach
                        </select>
                        <label for="" class="form-label">Pilih Kondisi</label>
                        <select class="form-control" name="kondisi" id="kondisi">
                            <option value="">Semua Kondisi</option>
                            <option value="baik">Baik</option>
                            <option value="rusak">Rusak</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
