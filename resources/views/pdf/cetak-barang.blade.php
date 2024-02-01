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

        <h3 style="text-align: center; text-transform: uppercase;">Data Barang Inventory Sekolah <br>
            SMK Avicena Rajeg <br>
            {{ Carbon\Carbon::now()->format('d-M-Y') }}
        </h3>
        <table id="customers">
            <tr>
                <th>No.</th>
                <th>Nama barang</th>
                <th>Kode Barang</th>
                <th>Jurusan</th>
                <th>Kondisi</th>
            </tr>
            @foreach ($barangs as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->barang_name }}</td>
                    <td>{{ $data->barang_code }}</td>
                    <td>{{ $data->jurusan_name }}</td>
                    <td>{{ $data->kondisi }}</td>
                </tr>
            @endforeach
            <tr>
                <td>Total Barang</td>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ $barangs->count() }}</td>
            </tr>
        </table>
    </body>

</html>
