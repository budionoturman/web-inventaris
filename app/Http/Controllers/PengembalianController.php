<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    public function index()
    {
        return view('pengembalian/index', [
            'peminjamans' => Peminjaman::where('status', 'like', 'belum kembali')->get(),
        ]);
    }

    public function kembalikan($id)
    {
        $peminjaman = Peminjaman::with('barang', 'user')->find($id);
        
        return view('pengembalian/kembalikan', [
            'data' => $peminjaman,
            'tgl_pinjam' => $peminjaman->tgl_pinjam,
            'totalBarang' => count($peminjaman->barang)
        ]);
    }

    public function storekembali(Request $request)
    {
        for($i = 0; $i < count($request->barang_id); $i++)
            {
                Barang::where('id', $request->barang_id[$i])->update(['status' => 'tersedia']);
             }
        

         $peminjam = Peminjaman::findOrFail($request->peminjam_id);

         $peminjam->tgl_kembali = $request->tgl_kembali;
         $peminjam->denda = $request->denda;
         $peminjam->status = "sudah kembali";
         $peminjam->save();

        
 

         return redirect('/pengembalians')->with('success', 'Berhasil Mengembalikan Barang');
    }

    public function history()
    {
        return view('pengembalian/history', [
            'peminjaman' => Peminjaman::where('status', 'sudah kembali')->get()
        ]);
    }
}
