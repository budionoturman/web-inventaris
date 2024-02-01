@extends('layouts/layout')
@section('container')
    <div class="container-fluid">
        <div class="row">
            <form action="/pengadaan/upload-kwitansi" method="post" enctype="multipart/form-data">
                <input type="hidden" name="pengadaan_id" value="{{ $pengadaan->id }}">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold mb-4">Form Upload Kwitansi Pembelian Barang</h5>
                        <div class="card">
                            <div class="card-body">
                                <label class="form-label">Nama Barang</label>
                                @if ($pengadaan->pengadaan_detail[0]->barang_id == null)
                                    @foreach ($pengadaan->pengadaan_detail as $barang)
                                        <input type="text" class="form-control my-2" name="barang_name[]"
                                            value="{{ $barang->barang_name }}" readonly>
                                        <input type="hidden" name="kategori_id[]" value="{{ $barang->kategori_id }}">
                                    @endforeach
                                @endif
                                @foreach ($pengadaan->barang as $barang)
                                    <input type="text" class="form-control my-2" name="barang_name[]"
                                        value="{{ $barang->barang_name }}" readonly>
                                    <input type="hidden" name="barang_id[]" value="{{ $barang->id }}">
                                    <input type="hidden" name="kategori_id[]" value="{{ $barang->kategori_id }}">
                                @endforeach
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <label for="" class="form-label">Upload Kwintansi</label>
                                <input type="file" class="form-control" id="kwitansi" name="kwitansi"
                                    onchange="previewImage()" required>
                            </div>
                            <div id="imagePreview" class="modal-footer">
                                <!-- Image preview will be displayed here -->
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <label for="" class="form-label">Tanggal Beli</label>
                                <input type="date" class="form-control" name="tgl_beli" id="tgl_beli"
                                    min="{{ $pengadaan->tgl_pengajuan }}" required>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection

<script>
    function previewImage() {
        var fileInput = document.getElementById('kwitansi');
        var imagePreview = document.getElementById('imagePreview');

        // Ensure that a file is selected
        if (fileInput.files.length > 0) {
            var file = fileInput.files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                // Create an image element and set its source to the data URL
                var img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'img-fluid'; // Optional: You can add a class for styling

                // Clear any previous previews and append the new image
                imagePreview.innerHTML = '';
                imagePreview.appendChild(img);
            };

            // Read the selected file as a data URL
            reader.readAsDataURL(file);
        } else {
            // No file selected, clear the preview
            imagePreview.innerHTML = '';
        }
    }
</script>
