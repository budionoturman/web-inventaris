@extends('layouts/layout')
@section('container')
    <div class="container-fluid">
        <div class="container-fluid">
            {{-- @if (session()->has('success'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif --}}
            <form action="/pegawai/peminjams" method="post">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold mb-4">Form Peminjaman Barang</h5>
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label class="form-label">Pegawai</label>
                                    <select id="user_id" name="user_id" class="form-control" readonly required>
                                        <option value="{{ $pegawai->id }}">
                                            {{ $pegawai->name }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="" class="form-label">Barang</label>
                                    <input type="text" id="myInput" oninput="myFunction()"
                                        placeholder="Search for names.." title="Type in a name">
                                    <ul id="myUL">
                                        @foreach ($barangs as $barang)
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input cb" type="checkbox"
                                                        value="{{ $barang->id }}" id="flexCheckDefault" name="barang_id[]"
                                                        placeholder="{{ $barang->barang_name }}">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        {{ $barang->barang_name }}. ({{ $barang->kategori->kategori_name }})
                                                    </label>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <form-group>
                                    <label for="" class="form-label">Barang Dipilih :</label>
                                    <ul class="ul">

                                    </ul>
                                </form-group>
                            </div>
                        </div>
                        {{-- <div class="card" id="barang3">
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
                                                            <div class="form-check">
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
                        </div> --}}

                        <div class="mb-3">
                            <label for="tgl_pinjam" class="form-label">Tanggal Pinjam</label>
                            <input type="date" class="form-control" name="tgl_pinjam" id="tgl_pinjam" required>
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
@endsection
