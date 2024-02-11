@extends('layouts/layout')
@section('container')
    <div class="container-fluid">
        <div class="container-fluid">
            @if (session()->has('success'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Form Pengembalian Barang</h5>
                    <div class="card">
                        <div class="card-body">
                            <form action="/storekembali" method="post" id="myForm">
                                @csrf
                                {{-- id peminjam --}}
                                <input type="hidden" name="peminjam_id" value="{{ $data->id }}">
                                <div class="form-group mb-3">
                                    @foreach ($data->barang as $data)
                                        @if ($data->pivot->status == 'sudah kembali')
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="" class="form-label">Sudah Kembali</label>
                                                            <input type="text" class="form-control"
                                                                placeholder="{{ $data->barang_name }}" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif($data->pivot->status == 'belum kembali')
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
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="baik" name="kondisi[]" id="flexCheckDefault">
                                                                <label class="form-check-label" for="flexCheckDefault">
                                                                    Baik
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="rusak" name="kondisi[]" id="flexCheckDefault">
                                                                <label class="form-check-label" for="flexCheckDefault">
                                                                    rusak
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="rusak berat" name="kondisi[]"
                                                                    id="flexCheckDefault">
                                                                <label class="form-check-label" for="flexCheckDefault">
                                                                    rusak berat
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="hilang" name="kondisi[]" id="flexCheckDefault">
                                                                <label class="form-check-label" for="flexCheckDefault">
                                                                    hilang
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        {{-- <div class="card">
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
                                        </div> --}}
                                    @endforeach
                                </div>
                                <input type="hidden" value="{{ $totalBarang }}" name="jumlah_dipinjam">
                                <input type="hidden" value="{{ $jumlah_kembali }}" name="jumlah_kembali">
                                <input type="hidden" class="form-control" name="id" id="id"
                                    value="{{ $data->id }}" readonly>
                                <div class="mb-3">
                                    <label for="tgl_pinjam" class="form-label">Tanggal Pinjam</label>

                                    <input type="date" class="form-control" name="tgl_pinjam" id="tgl_pinjam"
                                        value="{{ $tgl_pinjam }}" readonly>

                                </div>
                                <div class="mb-3">
                                    <label for="tgl_kembali" class="form-label">Tanggal Kembali</label>
                                    <input type="date" class="form-control" name="tgl_kembali" id="tgl_kembali"
                                        min="{{ $tgl_pinjam }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="denda" class="form-label">Denda Keterlambatan</label>
                                    <input type="number" class="form-control" name="dendaLihat" id="dendaLihat"
                                        required>
                                    <input type="hidden" class="form-control" name="denda" id="denda" required>
                                </div>
                                <button type="button" class="btn btn-outline-dark" onclick="resetForm()">reset</button>
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

                var totalBarang = {{ $totalBarang }};

                $("#tgl_kembali").change(function() {

                    var le = document.querySelectorAll('input[name="barang_id[]"]:checked').length;
                    console.log(le);

                    var start = moment($("#tgl_pinjam").val());
                    var end = moment($("#tgl_kembali").val());
                    if (end.diff(start, "days") > 5) {
                        var denda = (end.diff(start, "days") - 5) * 5000 * le;
                        var dendaLihat = denda.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');

                    } else {
                        var dendaLihat = 0;
                        var denda = 0;
                    }

                    $("#dendaLihat").val(dendaLihat);
                    $("#denda").val(denda);
                    console.log(denda);
                });
            });

            // the selector will match all input controls of type :checkbox
            // and attach a click event handler 
            // $("input:checkbox").on('click', function() {
            //     // in the handler, 'this' refers to the box clicked on
            //     var $box = $(this);
            //     if ($box.is(":checked")) {
            //         // the name of the box is retrieved using the .attr() method
            //         // as it is assumed and expected to be immutable
            //         var group = "input:checkbox[name='" + $box.attr("name") + "']";
            //         // the checked state of the group/box on the other hand will change
            //         // and the current value is retrieved using .prop() method
            //         $(group).prop("checked", false);
            //         $box.prop("checked", true);
            //     } else {
            //         $box.prop("checked", false);
            //     }
            // });

            function resetForm() {
                document.getElementById("myForm").reset();
            }
        </script>
    @endsection
