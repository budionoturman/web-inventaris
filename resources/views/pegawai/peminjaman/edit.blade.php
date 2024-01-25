@extends('layouts/layout')
@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Form Edit Peminjaman Barang</h5>

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fw-semibold mb-4">Pilih Barang yang ingin dibatalkan</h5>
                            <form action="/pegawai/peminjams/{{ $peminjaman->id }}" method="post" id="myForm">
                                @csrf
                                @method('put')
                                {{-- id peminjam --}}
                                <input type="hidden" name="id" value="{{ $peminjaman->id }}">
                                <input type="hidden" name="total" value="{{ $peminjaman->total }}">
                                <div class="form-group mb-3">
                                    @foreach ($peminjaman->barang as $data)
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-check">
                                                            <input class="form-check-input barang_id" type="checkbox"
                                                                value="{{ $data->id }}" name="barang_id[]"
                                                                id="flexCheckDefault barang_id[]">
                                                            <label class="form-check-label" for="flexCheckDefault">
                                                                {{ $data->barang_name }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" class="form-control"
                                                            value="{{ $data->barang_code }}" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mb-3">
                                    <label for="tgl_pinjam" class="form-label">Tanggal Pinjam</label>
                                    <input type="date" class="form-control" name="tgl_pinjam" id="tgl_pinjam"
                                        value="{{ $tgl_pinjam }}">

                                </div>
                                <button type="button" class="btn btn-outline-dark" onclick="resetForm()">reset</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
