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
            {{ Carbon\Carbon::now()->format('d-M-Y') }} <br>
        </h3>
        @foreach ($jurusans as $jurusan)
            <h3>
                {{ $jurusan->jurusan_name }}
            </h3>
            <table id="customers">
                <tr>
                    <th>Kategori</th>
                    <th>Nama barang</th>
                    <th>Kode Barang</th>
                    <th>Status</th>
                </tr>
                @php
                    $seen = []; // Array to keep track of seen values
                @endphp
                @foreach ($jurusans as $jurusan)
                    <!-- Output jurusan information -->
                    {{-- <tr>
                        <td colspan="6">{{ $jurusan->jurusan_name }}</td>
                    </tr> --}}

                    <!-- Loop through each kategori related to this jurusan -->
                    @foreach ($jurusan->kategori as $kategori)
                        <tr>
                            <td colspan="5">{{ $kategori->kategori_name }}</td>
                        </tr>
                        @foreach ($kategori->barang as $barang)
                            <tr>
                                <td></td>
                                <td>
                                    @if (!in_array($barang->barang_name, $seen))
                                        <!-- Display the distinct value -->
                                        {{ $barang->barang_name }}

                                        <!-- Add the value to the seen array -->
                                        @php
                                            $seen[] = $barang->barang_name;
                                        @endphp
                                    @endif
                                </td>
                                <td>{{ $barang->barang_code }}</td>
                                <td>{{ $barang->status }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td colspan="2">Jumlah Barang : </td>
                            <td>{{ $kategori->barang->count() }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </table>
        @endforeach

    </body>

</html>
