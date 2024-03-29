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
                <h5 class="card-title fw-semibold mb-4">Tambah Pengadaan Barang</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="/kondisi-barangs/{{ $barangs->id }}/tambah-pengadaan" method="post">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label for="barang_name" class="form-label">Nama Barang</label>
                                <input type="text" class="form-control" name="barang_name" id="barang_name"
                                    value="{{ old('barang_name', $barangs->barang_name) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="barang_code" class="form-label">Kode Barang</label>
                                <input type="hidden" class="form-control" name="barang_code" id="barang_code"
                                    value="{{ old('barang_code', $barangs->barang_code) }}">
                                <input type="text" class="form-control" name="barang_code" id="barang_code"
                                    value="{{ old('barang_code', $barangs->barang_code) }}" disabled readonly>
                            </div>
                            <div class="mb-3">
                                <label for="kategori_id" class="form-label">Kategori Barang</label>
                                <input type="hidden" class="form-control" name="kategori_id" id="kategori_id"
                                    value="{{ old('kategori_id', $barangs->kategori_id) }}" readonly>
                                <input type="text" class="form-control" name="" id=""
                                    value="{{ old('kategori_id', $barangs->kategori->kategori_name) }}" disabled readonly>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
