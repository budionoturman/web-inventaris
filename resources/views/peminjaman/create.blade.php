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
                    <h5 class="card-title fw-semibold mb-4">Form Peminjaman Barang</h5>
                    <div class="card">
                        <div class="card-body">
                            <form action="/peminjams" method="post">
                                @csrf
                                <div class="form-group mb-3">
                                    <label class="form-label">Pegawai</label>
                                    <select id="user_id" name="user_id" class="form-control selectpegawai select2"
                                        required>
                                        @foreach ($pegawai as $pegawai)
                                            @if (old('user_id') == $pegawai->id)
                                                <option value="{{ $pegawai->id }}">
                                                    {{ $pegawai->name }}
                                                </option>
                                            @else
                                                <option value="{{ $pegawai->id }}">
                                                    {{ $pegawai->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Barang 1</label>
                                            <select id="barang" name="barang_id[]"
                                                class="form-control selectbarang select2" required>

                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Barang 2</label>
                                            <select id="barang1" name="barang_id[]"
                                                class="form-control selectbarang select2" style="width: 100%;">
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="card" id="barang3">
                                    <div class="card-body">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Barang 3</label>
                                            <select id="barang2" name="barang_id[]"
                                                class="form-control selectbarang select2" style="width: 100%;">
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <input type="hidden" class="form-control" name="status" id="status" value="proses">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
    <script>
        $(function() {
            var dtToday = new Date();

            var month = dtToday.getMonth() + 1;
            var day = dtToday.getDate();
            var year = dtToday.getFullYear();
            if (month < 10)
                month = '0' + month.toString();
            if (day < 10)
                day = '0' + day.toString();

            var minDate = year + '-' + month + '-' + day;

            $('#tgl_pjm').attr('min', minDate);
        });


        var path = "{{ url('peminjam/create/') }}";

        $('#search').typeahead({

            source: function(query, process) {

                return $.get(path, {
                    query: query
                }, function(data) {

                    return process(data);
                });
            }
        });
    </script>
@endsection
