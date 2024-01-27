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
            <form action="/peminjams" method="post">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold mb-4">Form Peminjaman Barang</h5>
                        <div class="card">
                            <div class="card-body">
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
                            </div>
                        </div>


                        <div class="card" id="barang3">
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label class="form-label">Barang</label>
                                    <div class="table-responsive">
                                        <table class="table text-nowrap mb-0 align-middle" id="dataTable">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Nama Barang</th>
                                                    <th>Kode Barang</th>
                                                    <th>Kategori</th>
                                                    <th>Pilih</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($barangs as $barang)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $barang->barang_name }}</td>
                                                        <td>{{ $barang->barang_code }}</td>
                                                        <td>{{ $barang->kategori->kategori_name }}</td>
                                                        <td>
                                                            <div class="form-check" @required(true)>
                                                                <input class="form-check-input " type="checkbox"
                                                                    value="{{ $barang->id }}" name="barang_id[]"
                                                                    id="flexCheckDefault">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="tgl_pinjam" class="form-label">Tanggal Pinjam</label>
                            <input type="date" class="form-control" name="tgl_pinjam" required>
                        </div>

                        <div class="mb-3">
                            <input type="hidden" class="form-control" name="status" id="status" value="proses">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
    <script type="text/javascript">
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

            $('#tgl_pinjam').attr('min', minDate);
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
