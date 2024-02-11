@extends('layouts/layout')
@section('container')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <h5 class="card-title fw-semibold mb-4">Form Edit Barang</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="/request-barang-masuk/{{ $requestBarangs->id }}" method="post">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label for="user_id" class="form-label">Nama Pegawai</label>
                                <input type="hidden" class="form-control" name="user_id" id="user_id"
                                    value="{{ old('user_id', $requestBarangs->user_id) }}"y>
                                <input type="text" class="form-control" placeholder="{{ $requestBarangs->user->name }}"
                                    required readonly>
                            </div>
                            <div class="mb-3">
                                <label for="barang_name" class="form-label">Nama Barang</label>
                                <input type="text" class="form-control" name="barang_name" id="barang_name"
                                    value="{{ old('barang_name', $requestBarangs->barang_name) }}" required readonly>
                            </div>
                            <div class="mb-3">
                                <label for="kategori_id" class="form-label">Kategori Barang</label>
                                <input type="hidden" class="form-control" name="kategori_id" id="kategori_id"
                                    value="{{ old('kategori_id', $requestBarangs->kategori_id) }}" readonly>
                                <input type="text" class="form-control" name="" id=""
                                    value="{{ old('kategori_id', $requestBarangs->kategori->kategori_name) }}" disabled
                                    readonly>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status Barang</label>
                                <select class="form-control  " id="status " name="status" required>
                                    <option value="ditinjau"> Ditinjau </option>
                                    <option value="ditolak"> Ditolak </option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
