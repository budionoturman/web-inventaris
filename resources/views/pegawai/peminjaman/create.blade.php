@extends('layouts/layout')
@section('container')
    <style>
        <style>* {
            box-sizing: border-box;
        }

        #myInput {
            background-image: url('/css/searchicon.png');
            background-position: 10px 12px;
            background-repeat: no-repeat;
            width: 100%;
            font-size: 16px;
            padding: 12px 20px 12px 40px;
            border: 1px solid #ddd;
            margin-bottom: 12px;
        }

        #myUL {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        #myUL li a:hover:not(.header) {
            background-color: #eee;
        }

        #myUL li label {
            /* Prevent double borders */
            text-decoration: none;
            color: black;
            display: block
        }
    </style>
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
                                                        {{ $barang->barang_name }}
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


        $('.cb').click(function() {
            $('.ul').html("");
            $(".cb").each(function() {
                if ($(this).is(":checked")) {
                    var barangName = $(this).attr('placeholder');
                    $('.ul').append('<li>' + barangName + '</li>')
                }
            });
        });
    </script>

    <script>
        function myFunction() {
            var input, filter, ul, li, a, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            ul = document.getElementById("myUL");
            li = ul.getElementsByTagName("li");
            for (i = 0; i < li.length; i++) {
                a = li[i].getElementsByTagName("label")[0];
                txtValue = a.textContent || a.innerText;
                if (filter && txtValue.toUpperCase().indexOf(filter) > -1) {
                    li[i].style.display = "";
                    const checkboxCollection = document.querySelectorAll('input[type="checkbox"]')
                    const checkboxArray = [...checkboxCollection];
                    checkboxArray.forEach(input => input.addEventListener('change', drawList))

                    drawList();
                } else {
                    li[i].style.display = "none";
                }
            }
        }
        myFunction()

        function drawList() {
            const list = document.getElementById('myUL');
            const itemArray = [...list.children];

            const sortedArray = itemArray.sort((a, b) => {
                // First sort by checbox
                let aChecked = a.querySelector('input').checked;
                let bChecked = b.querySelector('input').checked;
                if (aChecked && !bChecked) return -1;
                if (!aChecked && bChecked) return 1;

                // If both are checked/not checked compare by textContent
                let aText = a.querySelector('label').textContent;
                let bText = b.querySelector('label').textContent;
                return aText > bText ? 1 : -1;
            })

            list.innerHTML = '';
            list.append(...sortedArray);
        }

        const checkboxCollection = document.querySelectorAll('input[type="checkbox"]')
        const checkboxArray = [...checkboxCollection];
        checkboxArray.forEach(input => input.addEventListener('change', drawList))

        drawList();
    </script>
@endsection
