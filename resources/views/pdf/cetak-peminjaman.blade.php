<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Peminjaman</title>

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
</head>

<body>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <section class="sheet padding-10mm">
                        {{-- <h3>Surat Keretangan </h3> --}}
                        <p class="text-center">FORMULIR PEMINJAMAN BARANG INVENTARIS</p>
                        <br>
                        <br>
                        <p>Data Peminjam :</p>
                        <p>
                            Kepada : {{ $peminjaman->user->name }} <br>
                            NIP : {{ $peminjaman->user->nip }} <br>
                            No.Hp : {{ $peminjaman->user->no_hp }} <br>
                            Jabatan : {{ $peminjaman->user->role->role_name }} <br>
                            <br>
                            <br>
                            Tanggal Pinjam : {{ Carbon\Carbon::parse($peminjaman->tgl_pinjam)->format('d-M-Y') }}
                        </p>
                        <br>
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
                        <br>
                        <br>
                        <br>
                        <table>
                            <thead>
                                <tr>
                                    <th>
                                        Peminjam <br>
                                        <br>
                                        <br>
                                        <br>
                                        <p>{{ $peminjaman->user->name }}</p>
                                    </th>
                                    <th>Staff Gudang<br>
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
</body>

</html>
