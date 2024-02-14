@extends('layouts/layout')
@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <form action="/pengadaan/simpan" method="post">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fw-semibold mb-4">Form Pengadaan Barang</h5>
                        </div>

                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <label class="form-label">Pegawai</label>
                                <input type="text" class="form-control" placeholder="{{ $user->name }}" readonly>
                                <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">
                                <label class="form-label mt-3">No Surat</label>
                                <input type="text" class="form-control" name="no_surat" value="{{ $no_surat }}"
                                    readonly>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <table class="table" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>Kategori</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah</th>
                                            <th>Add</th>
                                            <th>Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbl">
                                        <tr>
                                            <td>
                                                <select class='form-control' id='kategori_id[]' name='kategori_id[]'>
                                                    @foreach ($kategoris as $kategori)
                                                        <option value='{{ $kategori->id }}'>{{ $kategori->kategori_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input class="form-control" type='text' name='barang_name[]' required>
                                            </td>
                                            <td>
                                                <input class="form-control" type='number' name='jumlah[]' required>
                                            </td>
                                            <td>
                                                <input class="btn btn-success" type='button' value='+'
                                                    onclick='add_row()'>
                                            </td>
                                            <td><input class="btn btn-danger" type='button' value='-'
                                                    onclick='remove_row(this)'></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="tgl_pengajuan" class="form-label">Tanggal Pengajuan</label>
                                    <input type="date" class="form-control" name="tgl_pengajuan" id="tgl_pengajuan"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <input type="hidden" class="form-control" name="status" id="status"
                                        value="pengajuan">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-outline-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        function add_row() {
            var tr = document.createElement("tr");
            tr.innerHTML =
                "<td><select class='form-control selectkategori select2' id='kategori_id[]' name='kategori_id[]'>@foreach ($kategoris as $kategori)<option value='{{ $kategori->id }}'>{{ $kategori->kategori_name }}</option>@endforeach</select></td><td><input type='text'class='form-control' name='barang_name[]' required></td> <td><input class='form-control' type='number' name='jumlah[]' required></td> <td><input type='button' value='+' onclick='add_row()' class='btn btn-success btn-xs'></td> <td><input type='button' value='-' onclick='remove_row(this)' class='btn btn-danger btn-xs'></td>";
            document.getElementById("tbl").appendChild(tr);
        }

        function remove_row(e) {
            var n = document.querySelector("#tbl").querySelectorAll("tr").length;
            if (n > 1 && confirm("Barang ini akan dihapus") == true) {
                var ele = e.parentNode.parentNode;
                ele.remove();
                serial_no();
            }
        }
    </script>
@endsection
