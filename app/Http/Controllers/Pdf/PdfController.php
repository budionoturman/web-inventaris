<?php

namespace App\Http\Controllers\Pdf;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Pengadaan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

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
        return view('pdf/cetak-barang', [
            'barangs' => Barang::all()
        ]);
    }
}
