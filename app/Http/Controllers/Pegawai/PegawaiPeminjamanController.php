<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\PeminjamanDetail;
use Illuminate\Http\Request;

class PegawaiPeminjamanController extends Controller
{
    public function index()
    {
        $dataPeminjaman = Peminjaman::where('user_id', auth()->user()->id)
                            ->where('status', '!=', 'sudah kembali')                
        ->get();
        
        return view('pegawai/peminjaman/index', [
            'peminjamans' => $dataPeminjaman,
        ]);
    }

    public function create()
    {
        $dataBarang = Barang::where('status', 'LIKE', 'tersedia')
                    ->where('kondisi', 'LIKE', 'baik')
                    ->get();

        return view('pegawai/peminjaman/create', [
            'pegawai' => auth()->user(),
            'barangs' => $dataBarang
        ]);
    }

    public function store(Request $request)
    {
        if ($request->barang_id === null){
            return back()->with("success", "Pilih Barang Terlebih Dahulu");
        } elseif (count($request->barang_id) > 3) {
            return back()->with("success", "Barang Tidak Boleh Lebih Dari 3");
        }
        $validatedData = $request->validate([
            'user_id' => 'required',
            'status' => 'required',
            'tgl_pinjam' => 'required'
        ]);
        $validatedData['total'] = count($request->barang_id);

        $peminjaman = Peminjaman::create($validatedData);

        for($i = 0; $i < count($request->barang_id); $i++)
        {
            Barang::where('id', $request->barang_id[$i])->update(['status' => 'dipinjam']);
            PeminjamanDetail::create([ 
                'peminjam_id' => $peminjaman->id,
                'barang_id' => $request->barang_id[$i],

            ]);
        }

        return redirect('pegawai/peminjams')->with('success', 'Berhasil Melakukan Peminjaman');
    }

    public function history()
    {
        return view('pegawai/peminjaman/history', [
            'peminjaman' => Peminjaman::where('status', 'sudah kembali')
                            -> where('user_id', auth()->user()->id)
                            ->get()
        ]);
    }
}
