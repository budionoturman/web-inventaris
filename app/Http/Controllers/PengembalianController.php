<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\PembayaranDenda;
use App\Models\Peminjaman;
use App\Models\PeminjamanDetail;
use Illuminate\Http\Request;

use function PHPUnit\Framework\countOf;

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
        } elseif ($request->jumlah_dipinjam == count($request->barang_id)+$request->jumlah_kembali ) {
            // return "sudah kembali";
            for($i = 0; $i < count($request->barang_id); $i++)
            {
                Barang::where('id', $request->barang_id[$i])->update(['status' => 'tersedia']);

                Barang::where('id', $request->barang_id[$i])->update([
                    'kondisi' =>  $request->kondisi[$i] 
                ]);
                PeminjamanDetail::where('peminjam_id', $request->peminjam_id)
                                ->where('barang_id', $request->barang_id[$i])
                                ->update([
                                    'status' => 'sudah kembali',
                                    'kondisi' => $request->kondisi[$i]
                                ]);

                PeminjamanDetail::where('peminjam_id', $request->peminjam_id)
                                ->where('barang_id', $request->barang_id[$i])
                                ->where('kondisi', 'baik')
                                ->update([
                                    'denda' => 0
                                ]);
            }

            
            $peminjam = Peminjaman::with('peminjaman_detail')->find($request->peminjam_id);
            
            // cek jika yang kembali dalam keadaan baik semua maka is_denda_bayar menjadi 1 atau true
            if (count($peminjam->peminjaman_detail) == $peminjam->peminjaman_detail->where('kondisi', 'baik')->count()) {
                $peminjam = Peminjaman::with('peminjaman_detail')->find($request->peminjam_id);

                $peminjam->tgl_kembali = $request->tgl_kembali;
                $peminjam->denda += $request->denda;
                $peminjam->dendaTotal += $request->denda;
                $peminjam->status = "sudah kembali";
                $peminjam->is_denda_bayar = 1;
                $peminjam->jumlah_kembali = count($request->barang_id)+$request->jumlah_kembali;
                $peminjam->save();
                
                return redirect('/pengembalians')->with('success', 'Berhasil Mengembalikan Barang');
            }

            $peminjam->tgl_kembali = $request->tgl_kembali;
            $peminjam->denda += $request->denda;
            $peminjam->status = "sudah kembali";
            $peminjam->is_denda_bayar = 0;
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
                                    ->update([
                                        'status' => 'sudah kembali',
                                        'kondisi' => $request->kondisi[$i]
                                    ]);
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
        $dataPeminjaman = Peminjaman::with('barang')->where(function($query){
            $query->where('status', 'dibatalkan')
            ->orWhere('status', 'sudah kembali');
        })
        ->where('is_denda_bayar', 1)
        ->get();

        return view('pengembalian/history', [
            'peminjaman' => $dataPeminjaman
        ]);
    }

    public function preview($id)
    {
        $dataPengembalian = Peminjaman::with('barang')->findOrFail($id);
        
        return view('pengembalian/preview', [
            'pengembalian' => $dataPengembalian
        ]);
    }

    public function pembayaranDenda()
    {
        $dataPeminjaman = Peminjaman::with('barang')->where(function($query){
            $query->where('status', 'dibatalkan')
            ->orWhere('status', 'sudah kembali');
        })
        ->where('is_denda_bayar', 0)
        ->get();

        return view('pengembalian/denda', [
            'peminjaman' => $dataPeminjaman
        ]);
    }

    public function pembayaranDendaCreate($id)
    {
        $dataPengembalian = Peminjaman::with('barang', 'peminjaman_detail')->findOrFail($id);
        
        return view('pengembalian/bayar-denda', [
            'pengembalian' => $dataPengembalian
        ]);
    }

    public function pembayaranDendaStore(Request $request)
    {
        // return $request;
        $denda = $request->denda_terlambat;

        if (count($request->denda) == count(array_keys($request->denda, '0', true))) {
            // return "baik semua berarti kalo ini dieksekusi";
            for ($i = 0; $i < count($request->denda); $i++) {
                Peminjaman::findOrFail($request->id)->update([
                    'is_denda_bayar' => 1,
                    'dendaTotal' => $denda += $request->denda[$i],
                ]);
            }

            return redirect('/history')->with('success', 'Berhasil melakukan pembayaran denda pengembalian barang');
        }

        // return "ada yang rusak atau hilang berarti kalo ini dieksekusi";

        //validasi request body
        $validatedData = $request->validate([
            'bukti' => 'required',
            'tgl_bayar' => 'required'
        ]);
        $validatedData['peminjaman_id'] = $request->id;
        $file = $request->file('bukti');

        // update table peminjaman
        for ($i = 0; $i < count($request->denda); $i++) {
            Peminjaman::findOrFail($request->id)->update([
                'is_denda_bayar' => 1,
                'dendaTotal' => $denda += $request->denda[$i],
            ]);

            PeminjamanDetail::where('peminjam_id', $request->id)->where('barang_id', $request->barang_id[$i])->update([
                'denda' => $request->denda[$i]
            ]);
        }

        //store ke table pembayaran_denda
        $validatedData['file_name'] = $file->getClientOriginalName();
        $validatedData['file_type'] = $file->getMimeType();
        $validatedData['size'] = $file->getSize();
        $validatedData['path'] = $file->store('toPath', ['disk' => 'public_uploads_kwitansi']);
        PembayaranDenda::create($validatedData);


        return redirect('/history')->with('success', 'Berhasil melakukan pembayaran denda pengembalian barang');
    }
}
