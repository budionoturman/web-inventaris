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
                        <form action="/pegawai/request-barangs/{{ $requestBarang->id }}" method="post">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label for="user_id" class="form-label">Nama Pegawai</label>
                                <input type="hidden" class="form-control" name="user_id" id="user_id"
                                    value="{{ old('user_id', $requestBarang->user_id) }}"y>
                                <input type="text" class="form-control" placeholder="{{ $requestBarang->user->name }}"
                                    required readonly>
                            </div>
                            <div class="mb-3">
                                <label for="kategori_id" class="form-label">Kategori Barang</label>
                                <select class="form-control selectkategori select2" id="kategori_id" name="kategori_id"
                                    required>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="barang_name" class="form-label">Nama Barang</label>
                                <input type="text" class="form-control" name="barang_name" id="barang_name"
                                    value="{{ old('barang_name', $requestBarang->barang_name) }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
