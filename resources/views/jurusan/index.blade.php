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
                            <h5 class="card-title fw-semibold mb-4">Tabel Data Jurusan</h5>

                            @canany(['isKepalaStaff', 'isStaffGudang'])
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-outline-secondary m-1" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    Tambah
                                </button>
                            @endcanany
                        </div>
                        <div class="table-responsive">
                            <table class="table text-nowrap mb-0 align-middle" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Jurusan</th>
                                        <th>Kode Jurusan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jurusans as $jurusan)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $jurusan->jurusan_name }}</td>
                                            <td>{{ $jurusan->jurusan_code }}</td>
                                            <td class="d-flex inline">
                                                <a href="/jurusans/{{ $jurusan->id }}/edit">
                                                    <button type="button" class="btn btn-outline-warning m-1"><i
                                                            class="fa-solid fa-pen-to-square"></i></button>
                                                </a>
                                                <form action="/jurusans/{{ $jurusan->id }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-outline-danger m-1"><i
                                                            class="fa-solid fa-trash-can"></i></button>
                                                </form>
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


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Jurusan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="card">
                            <div class="card-body">
                                <form action="/jurusans" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="jurusan_name" class="form-label">Nama </label>
                                        <input type="text" class="form-control" name="jurusan_name" id="jurusan_name"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="jurusan_code" class="form-label">Kode Jurusan </label>
                                        <input type="text" class="form-control" name="jurusan_code" id="jurusan_code"
                                            required>
                                    </div>

                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
