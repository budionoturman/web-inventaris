@extends('layouts/layout')
@section('container')
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Form Pengembalian Barang</h5>
                    <div class="card">
                        <div class="card-body">
                            <form action="/storekembali" method="post">
                                @csrf
                                {{-- id peminjam --}}
                                <input type="hidden" name="peminjam_id" value="{{ $data->id }}">
                                <div class="form-group mb-3">
                                    @foreach ($data->barang as $data)
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="barang_name" class="form-label">Nama Barang</label>
                                                        <input type="text" class="form-control" name="barang_name[]"
                                                            id="barang_name[]" value="{{ $data->barang_name }}" readonly>
                                                        <input type="hidden" class="form-control" name="barang_id[]"
                                                            id="barang_id[]" value="{{ $data->id }}" readonly>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <input type="hidden" class="form-control" name="id" id="id"
                                    value="{{ $data->id }}" readonly>
                                <div class="mb-3">
                                    <label for="tgl_pinjam" class="form-label">Tanggal Pinjam</label>

                                    <input type="date" class="form-control" name="tgl_pinjam" id="tgl_pinjam"
                                        value="{{ $tgl_pinjam }}" readonly>

                                </div>
                                <div class="mb-3">
                                    <label for="tgl_kembali" class="form-label">Tanggal Kembali</label>
                                    <input type="date" class="form-control" name="tgl_kembali" id="tgl_kembali" required>
                                </div>
                                <div class="mb-3">
                                    <label for="no_hp" class="form-label">Denda</label>
                                    <input type="number" class="form-control" name="denda" id="denda" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- jQuery --}}
        <script src="{{ asset('admin-ui') }}/src/assets/libs/jquery/dist/jquery.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {

                //var end = moment($("#tgl_kmb").val());

                var totalBarang = {{ $totalBarang }};

                $("#tgl_kembali").change(function() {
                    var start = moment($("#tgl_pinjam").val());
                    var end = moment($("#tgl_kembali").val());
                    if (end.diff(start, "days") > 5) {
                        var denda = (end.diff(start, "days") - 5) * 5000 * totalBarang;

                    } else {
                        var denda = 0;
                    }
                    $("#denda").val(denda);
                    console.log(denda);
                });

            });
        </script>
    @endsection
