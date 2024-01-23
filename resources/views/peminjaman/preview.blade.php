@extends('layouts/layout')
<style>
    @page {
        size: A4
    }

    h1 {
        font-weight: bold;
        font-size: 20pt;
        text-align: center;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    .table th {
        padding: 8px 8px;
        border: 1px solid #000000;
        text-align: center;
    }

    .table td {
        padding: 3px 3px;
        border: 1px solid #000000;
    }

    .text-center {
        text-align: center;
    }
</style>
@section('container')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col">
                <a href="/peminjams">
                    <button type="button" class="btn btn-outline-warning m-1">Kembali
                    </button>
                </a>
                <a href="/peminjams-cetak/{{ $peminjaman->id }}" target="_blank">
                    <button type="button" class="btn btn-outline-secondary m-1">Cetak
                    </button>
                </a>
                <a href="/peminjams/proses/{{ $peminjaman->id }}">
                    <button type="button" class="btn btn-outline-success m-1">Proses
                    </button>
                </a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <section class="sheet padding-10mm">
                        {{-- <h3>Surat Keretangan </h3> --}}
                        <p>Perihal : Surat Peminjaman</p>
                        <p>Tanggal : {{ $peminjaman->tgl_pinjam }}</p>
                        <br>
                        <p>Dengan hormat,<br>
                            Yang bertanda tangan dibawah ini : <br>
                            Nama :{{ $staff->name }} <br>
                            NIP : {{ $staff->nip }}<br>
                            Jabatan : {{ $staff->role->role_name }}</p>

                        <p>Bermaksud untuk meminjamkan barang dengan rincian sebagai berikut:</p>
                        <table class="table" border="0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Barang</th>
                                    <th>Kode Barang</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($peminjaman->barang as $barang)
                                    <tr>
                                        <td class="text-center" width="1">{{ $loop->iteration }}</td>
                                        <td>{{ $barang->barang_name ?? 'null' }}</td>
                                        <td>{{ $barang->barang_code ?? 'null' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <p>
                            Kepada : {{ $peminjaman->user->name }} <br>
                            NIP : {{ $peminjaman->user->nip }} <br>
                            Jabatan : {{ $peminjaman->user->role->role_name }}
                        </p>
                        <p>Demikian kami sampaikan, atas perhatian dan kerjasamanya diucapkan terima kasih.</p>
                        <br>
                        <br>
                        <br>
                        <table>
                            <thead>
                                <tr>
                                    <th>Mengetahui,<br>
                                        Kepala SMK Avicena Rajeg <br>
                                        <br>
                                        <br>
                                        <br>
                                        <p>Muhammad Subur, S.Pd.,MM</p>
                                    </th>
                                    <th>Kaprog. TI<br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <p>Suhendra, S.Kom</p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
