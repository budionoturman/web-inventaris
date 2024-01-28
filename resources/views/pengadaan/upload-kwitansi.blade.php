@extends('layouts/layout')
@section('container')
    <div class="container-fluid">
        <div class="row">
            <form action="/pengadaan/upload-kwitansi" method="post" enctype="multipart/form-data">
                <input type="hidden" name="pengadaan_id" value="{{ $pengadaan->id }}">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold mb-4">Form Upload Kwitansi Pembelian Barang</h5>
                        <div class="card">
                            <div class="card-body">
                                <label class="form-label">Nama Barang</label>
                                @if ($pengadaan->pengadaan_detail[0]->barang_id == null)
                                    @foreach ($pengadaan->pengadaan_detail as $barang)
                                        <input type="text" class="form-control my-2" name="barang_name[]"
                                            value="{{ $barang->barang_name }}" readonly>
                                        <input type="hidden" name="kategori_id[]" value="{{ $barang->kategori_id }}">
                                    @endforeach
                                @endif
                                @foreach ($pengadaan->barang as $barang)
                                    <input type="text" class="form-control my-2" name="barang_name[]"
                                        value="{{ $barang->barang_name }}" readonly>
                                    <input type="hidden" name="barang_id[]" value="{{ $barang->id }}">
                                    <input type="hidden" name="kategori_id[]" value="{{ $barang->kategori_id }}">
                                @endforeach
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <label for="" class="form-label">Upload Kwintansi</label>
                                <input type="file" class="form-control" name="kwitansi" required>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <label for="" class="form-label">Tanggal Beli</label>
                                <input type="date" class="form-control" name="tgl_beli" id="tgl_beli"
                                    min="{{ $pengadaan->tgl_pengajuan }}" required>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
