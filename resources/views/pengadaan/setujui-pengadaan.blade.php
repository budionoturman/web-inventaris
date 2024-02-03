@extends('layouts/layout')
@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <form action="/pengadaan/setujui/simpan" method="post">
                    @csrf
                    <input class="form-control" type="hidden" value="{{ $pengadaan->id }}" name="pengadaan_id">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fw-semibold mb-4">Form Persetujuan Pengadaan Barang</h5>
                            <div class="card">
                                <div class="card-body">
                                    @if ($pengadaan->pengadaan_detail[0]->barang_id != null)
                                        <div class="row">
                                            <div class="col-1">
                                                @foreach ($pengadaan->pengadaan_detail as $pengadaan_detail)
                                                    <div class="form-check">
                                                        <input type="hidden" name="pengadaan_detail_id_semua[]"
                                                            value="{{ $pengadaan_detail->id }}">
                                                        <input class="form-check-input pengadaan_detail_id" type="checkbox"
                                                            value="{{ $pengadaan_detail->id }}" name="pengadaan_detail_id[]"
                                                            id="flexCheckDefault pengadaan_detail_id[]" checked> <br>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="col">
                                                @foreach ($pengadaan->barang as $item)
                                                    <label for=""
                                                        class="form-label">{{ $item->barang_name }}</label> <br>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                    @if ($pengadaan->pengadaan_detail[0]->barang_id == null)
                                        @foreach ($pengadaan->pengadaan_detail as $barang)
                                            <div class="row">
                                                <div class="col">
                                                    <label for="" class="form-label">Barang</label>
                                                    <input type="hidden" name="pengadaan_detail_id_biasa[]"
                                                        value="{{ $barang->id }}">
                                                    <input type="text" class="form-control mb-2" name="barang_name[]"
                                                        value="{{ $barang->barang_name }}" readonly>
                                                </div>
                                                <div class="col">
                                                    <label for="" class="form-label">jumlah</label>
                                                    <input type="text" class="form-control mb-2" name="jumlah[]"
                                                        value="{{ $barang->jumlah }}">
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="/pengadaans">
                        <button type="button" class="btn btn-outline-danger">kembali</button>
                    </a>
                    <button type="submit" class="btn btn-success">Setujui</button>
                </form>
            </div>
        </div>
    </div>
@endsection
