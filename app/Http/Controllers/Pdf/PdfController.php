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
use function PHPSTORM_META\map;

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
        $kategori_id = $request->kategori_id;
        $kondisi = $request->kondisi;

        // $data = Jurusan::with(['kategori' => function($query) use($kategori_id) {
        //                     $query->where('id', $kategori_id);
        //                 } , 'kategori.barang' => function($query) use($kondisi) {
        //                     $query->where('kondisi', $kondisi);
        //                 }])
        //         ->Where('id', $request->jurusan_id)
        //         ->get();

        $dataBarangSemua = Jurusan::with(['kategori', 'kategori.barang'])->get();

        $dataBarangByJurusan =  Jurusan::with(['kategori', 'kategori.barang'])->where('id', $request->jurusan_id)->get();
        
        $dataBarangByKategori = Jurusan::with(['kategori' => function($query) use($kategori_id) {
                                            $query->where('id', $kategori_id);
                                        } , 'kategori.barang'])
                                ->get();

        $dataBarangByKondisi =Jurusan::with(['kategori', 'kategori.barang' => function($query) use($kondisi) {
                                            $query->where('kondisi', $kondisi);
                                        }])
                                ->get();
        
        $dataBarangByJurusanAndKategori = Jurusan::with(['kategori' => function($query) use($kategori_id) {
                                                    $query->where('id', $kategori_id);
                                                } , 'kategori.barang'])
                                        ->Where('id', $request->jurusan_id)
                                        ->get();

        $dataBarangByKondisiAndKategori = Jurusan::with(['kategori' => function($query) use($kategori_id) {
                                                    $query->where('id', $kategori_id);
                                                } , 'kategori.barang' => function($query) use($kondisi) {
                                                    $query->where('kondisi', $kondisi);
                                                }])
                                        ->get();
                                
        $dataBarangByJurusanAndKondisi = Jurusan::with(['kategori', 'kategori.barang' => function($query) use($kondisi) {
                                                    $query->where('kondisi', $kondisi);
                                                }])
                                        ->Where('id', $request->jurusan_id)
                                        ->get();
        
        $dataBarangByJurusanAndKondisiAndKategori = Jurusan::with(['kategori' => function($query) use($kategori_id) {
                                                                $query->where('id', $kategori_id);
                                                            } , 'kategori.barang' => function($query) use($kondisi) {
                                                                $query->where('kondisi', $kondisi);
                                                            }])
                                                    ->Where('id', $request->jurusan_id)
                                                    ->get();

        if($request->jurusan_id != null && $request->kondisi != null && $request->kategori_id != null) {
            $pdf = PDF::loadView('pdf/cetak-barang', [
                'jurusans' => $dataBarangByJurusanAndKondisiAndKategori
            ]);
            return $pdf->stream('data-barang.pdf');
        } elseif($request->jurusan_id != null && $request->kategori_id != null) {
            $pdf = PDF::loadView('pdf/cetak-barang', [
                'jurusans' => $dataBarangByJurusanAndKategori
            ]);
            return $pdf->stream('data-barang.pdf');
        } elseif($request->kondisi != null && $request->kategori_id != null) {
            $pdf = PDF::loadView('pdf/cetak-barang', [
                'jurusans' => $dataBarangByKondisiAndKategori
            ]);
            return $pdf->stream('data-barang.pdf');
        } elseif ($request->jurusan_id != null && $request->kondisi != null) {
            // return "by kategori dan kondisi";
            $pdf = PDF::loadView('pdf/cetak-barang', [
                'jurusans' => $dataBarangByJurusanAndKondisi
            ]);
            return $pdf->stream('data-barang.pdf');

        } elseif ($request->jurusan_id != null) {
            // return "by jurusan";
            $pdf = PDF::loadView('pdf/cetak-barang', [
                'jurusans' => $dataBarangByJurusan
            ]);
            return $pdf->stream('data-barang.pdf');

        } elseif($request->kategori_id != null) {
            // return "by kategori";
            $pdf = PDF::loadView('pdf/cetak-barang', [
                'jurusans' => $dataBarangByKategori
            ]);
            return $pdf->stream('data-barang.pdf');
        } elseif ($request->kondisi != null) {
            // return "by  kondisi";
            $pdf = PDF::loadView('pdf/cetak-barang', [
                'jurusans' => $dataBarangByKondisi
            ]);
            return $pdf->stream('data-barang.pdf');
        }

        // return "semua ";
        $pdf = PDF::loadView('pdf/cetak-barang', [
            'jurusans' => $dataBarangSemua,
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

    public function cetakPeminjamanBelumKembali(Request $request)
    {
        // return $request;
        $dataPeminjaman = Peminjaman::with('barang')
                            ->where('status', 'belum kembali')
                            ->whereBetween('tgl_pinjam', [$request->tgl_from, $request->tgl_to])
                            ->get();

        $pdf = PDF::loadView('pdf/cetak-data-peminjaman', [
            'peminjamans' => $dataPeminjaman,
            'tanggal' => $request
        ]);
        return $pdf->stream('data-peminjaman-barang.pdf');
    }

    public function cetakPeminjamanHistory(Request $request)
    {
        $dataPeminjaman = Peminjaman::with('barang')
                            ->where('status', 'sudah kembali')
                            ->whereBetween('tgl_pinjam', [$request->tgl_from, $request->tgl_to])
                            ->get();

        $pdf = PDF::loadView('pdf/cetak-data-peminjaman', [
            'peminjamans' => $dataPeminjaman,
            'tanggal' => $request
        ]);
        return $pdf->stream('data-peminjaman-barang.pdf');
    }
}
