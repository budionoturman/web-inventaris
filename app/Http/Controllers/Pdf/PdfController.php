<?php

namespace App\Http\Controllers\Pdf;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\Pengadaan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;

class PdfController extends Controller
{
    public function cetakPengadaan($id)
    {
        $dataPengadaan = Pengadaan::findOrFail($id);

        $pdf = PDF::loadView('pdf/cetak-pengadaan', [
            'pengadaan' => $dataPengadaan, 
        ]);
        return $pdf->stream('pengadaan-'.$dataPengadaan->no_surat.'.pdf');
    }

    public function cetakBarangs()
    {
        $pdf = PDF::loadView('pdf/cetak-barang', [
            'barangs' => Barang::all()
        ]);
        return $pdf->stream('data-barang.pdf');
    }

    public function cetakPeminjaman($id)
    {
        $dataPeminjaman = Peminjaman::findOrFail($id);
        $dataStaff = auth()->user();

        $pdf = PDF::loadView('pdf/cetak-peminjaman', [
            'peminjaman' => $dataPeminjaman,
            'staff' => $dataStaff
        ]);
        return $pdf->stream('peminjaman.pdf');
    }
}
