@extends('layouts/layout')
@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <label for="" class="form-label">Barang</label>
                        <form action="/pembayaran-denda/create" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="{{ $pengembalian->id }}">
                            <input type="hidden" name="denda_terlambat" value="{{ $pengembalian->denda }}">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <label for="" class="form-label">Barang</label>
                                    </div>
                                    <div class="col">
                                        <label for="" class="form-label">Kondisi Saat Kembali</label>
                                    </div>
                                    <div class="col">
                                        <label for="" class="form-label">Masukan Nominal</label>
                                    </div>
                                </div>
                                @foreach ($pengembalian->peminjaman_detail as $data)
                                    <div class="row">
                                        <div class="col">
                                            <input type="hidden" name="barang_id[]" value="{{ $data->barang->id }}">
                                            <input type="text" class="form-control mb-2"
                                                placeholder="{{ $data->barang->barang_name }}" readonly>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control mb-2"
                                                placeholder="{{ $data->kondisi }}" readonly>
                                        </div>
                                        <div class="col">
                                            @if ($data->kondisi == 'baik')
                                                <input type="text" class="form-control mb-2" value="{{ $data->denda }}"
                                                    name="denda[]" readonly>
                                            @endif
                                            @if ($data->kondisi != 'baik')
                                                <input type="text" class="form-control mb-2" name="denda[]"
                                                    id="rupiah[]" required>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @if (
                                $pengembalian->peminjaman_detail[0]->kondisi != 'baik' ||
                                    $pengembalian->peminjaman_detail[1]->kondisi != 'baik' ||
                                    $pengembalian->peminjaman_detail[2]->kondisi != 'baik')
                                <div class="card-body">
                                    <label for="" class="form-label">Upload Bukti Pembayaran</label>
                                    <input type="file" class="form-control" id="bukti" name="bukti" required>
                                </div>
                                <div class="card-body">
                                    <label for="" class="form-label">Tanggal pembayaran</label>
                                    <input type="date" class="form-control" id="tgl_bayar" name="tgl_bayar"
                                        min="{{ $pengembalian->tgl_pinjam }}" required>
                                </div>
                            @endif
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        // var rupiah = document.getElementById('rupiah[]');
        // rupiah.addEventListener('keyup', function(e) {
        //     // tambahkan 'Rp.' pada saat form di ketik
        //     // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        //     rupiah.value = formatRupiah(this.value, 'Rp. ');
        // });

        // /* Fungsi formatRupiah */
        // function formatRupiah(angka, prefix) {
        //     var number_string = angka.replace(/[^,\d]/g, '').toString(),
        //         split = number_string.split(','),
        //         sisa = split[0].length % 3,
        //         rupiah = split[0].substr(0, sisa),
        //         ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        //     // tambahkan titik jika yang di input sudah menjadi angka ribuan
        //     if (ribuan) {
        //         separator = sisa ? '.' : '';
        //         rupiah += separator + ribuan.join('.');
        //     }

        //     rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        //     return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        // }
    </script>
@endsection
