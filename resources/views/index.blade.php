@extends('layouts/layout')
@section('container')
    <div class="container-fluid">
        <div class="row">
            @canany(['isKepalaSekolah', 'isKepalaStaff', 'isStaffGudang'])
                <div class="row-lg-12 d-flex align-items-stretch">
                    <div class="mx-4">
                        <div class="card" style="width: 18rem; mx-10;">
                            <img src="https://www.quipper.com/id/blog/wp-content/uploads/2022/09/Teknik-Komputer-Jaringan.webp"
                                class="img-thumbnail" alt="..." style="widows: 100px; height:250px">
                            <div class="card-body">
                                <h5 class="card-title">Jumlah Barang</h5>
                                <p class="card-text">
                                    Teknik Komputer Jaringan :
                                    @if (is_null($jumlahTkj))
                                        0
                                    @else
                                        {{ $jumlahTkj }}
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mx-4">
                        <div class="card" style="width: 18rem; mx-10;">
                            <img src="https://i.pinimg.com/736x/47/55/2c/47552cff6c11d9fb901a904c48b823ee.jpg"
                                class="img-thumbnail" alt="..." style="widows: 100px; height:250px">
                            <div class="card-body">
                                <h5 class="card-title">Jumlah Barang</h5>
                                <p class="card-text">
                                    Teknik Otomotif :
                                    @if (is_null($jumlahTo))
                                        0
                                    @else
                                        {{ $jumlahTo }}
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mx-4">
                        <div class="card" style="width: 18rem; mx-10;">
                            <img src="https://img.freepik.com/premium-vector/minimal-multimedia-logo-template_416562-755.jpg?w=740"
                                class="img-thumbnail" alt="..." style="widows: 100px; height:250px">
                            <div class="card-body">
                                <h5 class="card-title">Jumlah Barang</h5>
                                <p class="card-text">
                                    Multimedia :
                                    @if (is_null($jumlahMm))
                                        0
                                    @else
                                        {{ $jumlahMm }}
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endcanany

            <div class="col-lg-12 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-semibold mb-4">Data Barang Inventaris</h5>
                        <div class="table-responsive">
                            <table class="table text-nowrap mb-0 align-middle" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Barang</th>
                                        <th>Kode Barang</th>
                                        <th>Kategori</th>
                                        @can('isStaffGudang')
                                            <th>Aksi</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($barangs as $barang)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $barang->barang_name }}</td>
                                            <td>{{ $barang->barang_code }}</td>
                                            <td>{{ $barang->kategori->kategori_name }}</td>
                                            @can('isStaffGudang')
                                                <td class="d-flex inline">
                                                    <a href="/barangs/{{ $barang->id }}/edit">
                                                        <button type="button" class="btn btn-outline-warning m-1"><i
                                                                class="fa-solid fa-pen-to-square"></i></button>
                                                    </a>
                                                    <form action="/barangs/{{ $barang->id }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-outline-danger m-1"><i
                                                                class="fa-solid fa-trash-can"></i></button>
                                                    </form>
                                                </td>
                                            @endcan
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @canany(['isKepalaSekolah', 'isKepalaStaf', 'isStaffGudang'])
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-semibold mb-4">Data Peminjam Barang Inventaris</h5>
                            <div class="table-responsive">
                                <table class="table text-nowrap mb-0 align-middle" id="dataTable">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">No</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Nama</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">No. Hp</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Barang</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Tgl Pinjam</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Tgl Kembali</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Status</h6>
                                            </th>
                                            @can('isKepalaStaff')
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0 text-center">Aksi</h6>
                                                </th>
                                            @endcan
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($peminjamans as $peminjaman)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $peminjaman->user->name }}</td>
                                                <td>{{ $peminjaman->user->no_hp }}</td>
                                                <td> <?php
                                                foreach ($peminjaman->barang as $brg) {
                                                    echo $brg->barang_name . '<br>';
                                                }
                                                ?>
                                                </td>
                                                <td>{{ $peminjaman->tgl_pinjam }}</td>
                                                <td>{{ $peminjaman->tgl_kembali }}</td>
                                                <td>
                                                    @if ($peminjaman->status === 'belum kembali')
                                                        <button class="btn btn-danger m-1">{{ $peminjaman->status }}</button>
                                                    @elseif($peminjaman->status === 'proses')
                                                        <a href="/proses/{{ $peminjaman->id }}">
                                                            <button type="button"
                                                                class="btn btn-success m-1">{{ $peminjaman->status }}</button>
                                                        </a>
                                                    @else
                                                        <button class="btn btn-success m-1">{{ $peminjaman->status }}</button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcanany
@endsection
