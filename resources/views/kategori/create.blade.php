@extends('layouts/layout')
@section('container')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">

                <h5 class="card-title fw-semibold mb-4">Form Tambah kategori</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="/kategoris/" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="kategori_name" class="form-label">Nama </label>
                                <input type="text" class="form-control" name="kategori_name" id="kategori_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="kategori_code" class="form-label">Kode Kategori </label>
                                <input type="text" class="form-control @error('kategori_code') is-invalid @enderror"
                                    name="kategori_code" id="kategori_code" required>
                                @error('kategori_code')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="jurusan_id" class="form-label">Jurusan</label>
                                <select class="form-control selectjurusan select2" id="jurusan_id selectjurusan"
                                    name="jurusan_id" required>
                                    @foreach ($jurusans as $jurusan)
                                        @if (old('jurusan_id') == $jurusan->id)
                                            <option value="{{ $jurusan->id }}">
                                                {{ $jurusan->jurusan_name }}
                                            </option>
                                        @else
                                            <option value="{{ $jurusan->id }}">
                                                {{ $jurusan->jurusan_name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
