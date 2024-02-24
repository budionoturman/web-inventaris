<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <style>
            #customers {
                font-family: Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            #customers td,
            #customers th {
                border: 1px solid #ddd;
                padding: 8px;
            }

            #customers tr:nth-child(even) {
                background-color: #f2f2f2;
            }

            #customers tr:hover {
                background-color: #ddd;
            }

            #customers th {
                padding-top: 12px;
                padding-bottom: 12px;
                text-align: left;
                background-color: rgba(98, 69, 245, 0.739);
                color: white;
            }
        </style>
    </head>

    <body>

        <h3 style="text-align: center; text-transform: uppercase;">Data Peminjaman Barang<br>
            SMK Avicena Rajeg <br>
            {{ Carbon\Carbon::parse($tanggal->tgl_from)->format('d-M-Y') }} sampai
            {{ Carbon\Carbon::parse($tanggal->tgl_to)->format('d-M-Y') }}
        </h3>
        <table id="customers">
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>No. Hp</th>
                <th>Tanggal Pinjam</th>
                <th>Barang</th>
            </tr>
            @foreach ($peminjamans as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->user->name }}</td>
                    <td>{{ $data->user->no_hp }}</td>
                    <td>{{ Carbon\Carbon::parse($data->tgl_pinjam)->format('d-M-Y') }}</td>
                    <td> <?php
                    foreach ($data->barang as $brg) {
                        echo $brg->barang_name . '<br>';
                    }
                    ?>
                    </td>
                </tr>
            @endforeach
        </table>
    </body>

</html>
