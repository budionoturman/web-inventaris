<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\PeminjamanDetail;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::where(function($query){
                            $query->where('status', 'LIKE', 'belum kembali')
                            ->orWhere('status', 'LIKE', 'kembali sebagian');
                        })->get();

        return view('pengembalian/index', [
            'peminjamans' => $peminjamans
        ]);
    }

    public function kembalikan($id)
    {
        $peminjaman = Peminjaman::with('barang', 'user')->find($id);
        
        return view('pengembalian/kembalikan', [
            'data' => $peminjaman,
            'tgl_pinjam' => $peminjaman->tgl_pinjam,
            'jumlah_kembali' =>$peminjaman->jumlah_kembali,
            'totalBarang' => count($peminjaman->barang)
        ]);
    }

    public function storekembali(Request $request)
    {
        // return $request;
        if ($request->barang_id === null || $request->kondisi === null) {
            return back()->with('success', 'Pilih Barang atau Kondisi terlebih dahulu');
        } elseif (count($request->barang_id) != count($request->kondisi)) {
            return back()->with('success', 'Jumlah Barang dan kondisi tidak sama');
        } elseif ($request->jumlah_dipinjam == count($request->barang_id)+$request->jumlah_kembali ){
            // return "sudah kembali";
            for($i = 0; $i < count($request->barang_id); $i++)
            {
                Barang::where('id', $request->barang_id[$i])->update(['status' => 'tersedia']);

                Barang::where('id', $request->barang_id[$i])->update([
                    'kondisi' =>  $request->kondisi[$i] 
                ]);
            }
            PeminjamanDetail::where('peminjam_id', $request->peminjam_id)->update([
                'status' => 'sudah kembali'
            ]);
    
            $peminjam = Peminjaman::findOrFail($request->peminjam_id);
    
            $peminjam->tgl_kembali = $request->tgl_kembali;
            $peminjam->denda += $request->denda;
            $peminjam->status = "sudah kembali";
            $peminjam->jumlah_kembali = count($request->barang_id)+$request->jumlah_kembali;
            $peminjam->save();
             
            return redirect('/pengembalians')->with('success', 'Berhasil Mengembalikan Barang');
        } else {
            // return "kembali sebagian";
            for($i = 0; $i < count($request->barang_id); $i++)
            {
                Barang::where('id', $request->barang_id[$i])->update(['status' => 'tersedia']);

                Barang::where('id', $request->barang_id[$i])->update([
                    'kondisi' =>  $request->kondisi[$i] 
                ]);
                PeminjamanDetail::where('peminjam_id', $request->peminjam_id)
                                    ->where('barang_id', $request->barang_id[$i])
                                    ->update(['status' => 'sudah kembali']);
            }
    
            $peminjam = Peminjaman::findOrFail($request->peminjam_id);
    
            $peminjam->tgl_kembali = $request->tgl_kembali;
            $peminjam->denda += $request->denda;
            $peminjam->status = "kembali sebagian";
            $peminjam->jumlah_kembali = count($request->barang_id)+$request->jumlah_kembali;
            $peminjam->save();
             
            return redirect('/pengembalians')->with('success', 'Berhasil Mengembalikan Barang');
        }
    }

    public function history()
    {
        return view('pengembalian/history', [
            'peminjaman' => Peminjaman::where('status', 'sudah kembali')->get()
        ]);
    }
}
