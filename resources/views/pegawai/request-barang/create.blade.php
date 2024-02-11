@extends('layouts/layout')
@section('container')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">

                <h5 class="card-title fw-semibold mb-4">Form Tambah kategori</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="/pegawai/request-barangs/" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="kategori_id" class="form-label">Kategori</label>
                                <select class="form-control selectkategori select2" id="kategori_id" name="kategori_id"
                                    required>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="barang_name" class="form-label">Nama Barang</label>
                                <input type="text" class="form-control" name="barang_name" id="barang_name" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
