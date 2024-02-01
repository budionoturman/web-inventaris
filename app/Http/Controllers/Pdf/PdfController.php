<?php

namespace App\Http\Controllers\Pdf;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Jurusan;
use App\Models\Peminjaman;
use App\Models\Pengadaan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Support\Facades\DB;
use Nette\Utils\Strings;

use function Laravel\Prompts\select;

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

    public function cetakBarangs(Request $request)
    {
        $dataBarangSemua = DB::table('barangs as B')
                        ->join('kategoris as K', 'B.kategori_id', '=', 'K.id')
                        ->join('jurusans as J', 'K.jurusan_id', '=', 'J.id')
                        ->get();
        
        $dataBarangByJurusan = DB::table('barangs as B')
                                ->join('kategoris as K', 'B.kategori_id', '=', 'K.id')
                                ->join('jurusans as J', 'K.jurusan_id', '=', 'J.id')
                                ->where('j.id', '=', $request->jurusan_id)
                                ->get();

        $dataBarangByKondisi = DB::table('barangs as B')
                                ->join('kategoris as K', 'B.kategori_id', '=', 'K.id')
                                ->join('jurusans as J', 'K.jurusan_id', '=', 'J.id')
                                ->where('B.kondisi', '=', $request->kondisi)
                                ->get();
        
        $dataBarangByJurusanAndKategori = DB::table('barangs as B')
                                        ->join('kategoris as K', 'B.kategori_id', '=', 'K.id')
                                        ->join('jurusans as J', 'K.jurusan_id', '=', 'J.id')
                                        ->where('j.id', '=', $request->jurusan_id)
                                        ->where('K.id', '=', $request->kategori_id)
                                        ->get();

        $dataBarangByKondisiAndKategori = DB::table('barangs as B')
                                        ->join('kategoris as K', 'B.kategori_id', '=', 'K.id')
                                        ->join('jurusans as J', 'K.jurusan_id', '=', 'J.id')
                                        ->where('B.kondisi', '=', $request->kondisi)
                                        ->where('K.id', '=', $request->kategori_id)
                                        ->get();
                                
        $dataBarangByJurusanAndKondisi = DB::table('barangs as B')
                                        ->join('kategoris as K', 'B.kategori_id', '=', 'K.id')
                                        ->join('jurusans as J', 'K.jurusan_id', '=', 'J.id')
                                        ->where('j.id', '=', $request->jurusan_id)
                                        ->where('B.kondisi', '=', $request->kondisi)
                                        ->get();
        
        $dataBarangByJurusanAndKondisiAndKategori = DB::table('barangs as B')
                                                    ->join('kategoris as K', 'B.kategori_id', '=', 'K.id')
                                                    ->join('jurusans as J', 'K.jurusan_id', '=', 'J.id')
                                                    ->where('j.id', '=', $request->jurusan_id)
                                                    ->where('K.id', '=', $request->kategori_id)
                                                    ->where('B.kondisi', '=', $request->kondisi)
                                                    ->get();
        if($request->jurusan_id != null && $request->kondisi != null && $request->kategori_id != null) {
            $pdf = PDF::loadView('pdf/cetak-barang', [
                'barangs' => $dataBarangByJurusanAndKondisiAndKategori
            ]);
            return $pdf->stream('data-barang.pdf');
        } elseif($request->jurusan_id != null && $request->kategori_id != null) {
            $pdf = PDF::loadView('pdf/cetak-barang', [
                'barangs' => $dataBarangByJurusanAndKategori
            ]);
            return $pdf->stream('data-barang.pdf');
        } elseif($request->kondisi != null && $request->kategori_id != null) {
            $pdf = PDF::loadView('pdf/cetak-barang', [
                'barangs' => $dataBarangByKondisiAndKategori
            ]);
            return $pdf->stream('data-barang.pdf');
        } elseif ($request->jurusan_id != null && $request->kondisi != null) {
            // return "by kategori dan kondisi";
            $pdf = PDF::loadView('pdf/cetak-barang', [
                'barangs' => $dataBarangByJurusanAndKondisi
            ]);
            return $pdf->stream('data-barang.pdf');

        } elseif ($request->jurusan_id != null) {
            // return "by jurusan";
            $pdf = PDF::loadView('pdf/cetak-barang', [
                'barangs' => $dataBarangByJurusan
            ]);
            return $pdf->stream('data-barang.pdf');

        } elseif ($request->kondisi != null) {
            // return "by  kondisi";
            $pdf = PDF::loadView('pdf/cetak-barang', [
                'barangs' => $dataBarangByKondisi
            ]);
            return $pdf->stream('data-barang.pdf');
        }

        // return "semua ";
        $pdf = PDF::loadView('pdf/cetak-barang', [
            'barangs' => $dataBarangSemua
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

    public function cetakHistory($id)
    {
        $dataPengembalian = Peminjaman::with('barang')->findOrFail($id);
        
        $pdf = PDF::loadView('pdf/cetak-history', [
            'pengembalian' => $dataPengembalian
        ]);
        return $pdf->stream('history.pdf');
    }
}
