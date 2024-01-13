@extends('layouts/layout')
@section('container')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">

                <h5 class="card-title fw-semibold mb-4">Form Edit Jurusan</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="/jurusans/{{ $jurusan->id }}" method="post">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label for="jurusan_name" class="form-label">Nama </label>
                                <input type="text" class="form-control" name="jurusan_name" id="jurusan_name"
                                    value="{{ old('jurusan_name', $jurusan->jurusan_name) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="jurusan_code" class="form-label">Kode Jurusan </label>
                                <input type="text" class="form-control" name="jurusan_code" id="jurusan_code"
                                    value="{{ old('jurusan_code', $jurusan->jurusan_code) }}" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script></script>
@endsection
