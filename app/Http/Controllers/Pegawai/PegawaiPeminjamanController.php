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
        $dataBarangDipinjam = Peminjaman::where('user_id', auth()->user()->id)
                            ->where(function($query){
                                $query->where('status', '!=', 'sudah kembali')
                                ->where('status', '!=', 'dibatalkan');
                            })
                            ->count('total');
        
        $dataPeminjaman = Peminjaman::where('user_id', auth()->user()->id)
                            ->where(function($query){
                                $query->where('status', '!=', 'sudah kembali')
                                ->where('status', '!=', 'dibatalkan');
                            })->get();
        
        return view('pegawai/peminjaman/index', [
            'peminjamans' => $dataPeminjaman,
            'totalDipinjam' => $dataBarangDipinjam
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
        $validatedData['jumlah_kembali'] = 0;

        $peminjaman = Peminjaman::create($validatedData);

        for($i = 0; $i < count($request->barang_id); $i++)
        {
            Barang::where('id', $request->barang_id[$i])->update(['status' => 'dipinjam']);
            PeminjamanDetail::create([ 
                'peminjam_id' => $peminjaman->id,
                'barang_id' => $request->barang_id[$i],
                'status' => 'belum kembali'
            ]);
        }

        return redirect('pegawai/peminjams')->with('success', 'Berhasil Melakukan Peminjaman');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $dataPeminjaman = Peminjaman::with('barang', 'user')->find($id);
        // return $dataPeminjaman;
        return view('pegawai/peminjaman/edit', [
            'peminjaman' => $dataPeminjaman,
            'tgl_pinjam' => $dataPeminjaman->tgl_pinjam
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'tgl_pinjam' => 'required'
        ]);

        if ($request->barang_id == null) {
            Peminjaman::where('id', $request->id)->update($validatedData);
            return redirect('pegawai/peminjams')->with('success', 'Berhasil Ubah Peminjaman');
        }
        else if (count($request->barang_id) == $request->total) {
            // return 'batal karena barang di ceklis semua';
            Peminjaman::where('id', $request->id)->update(['status' => 'dibatalkan']);
            for($i = 0; $i < count($request->barang_id); $i++)
            {
                Barang::where('id', $request->barang_id[$i])->update(['status' => 'tersedia']);
            }
            return redirect('pegawai/peminjams')->with('success', 'Peminjaman Dibatalkan karena barang di ceklis semua');
        }

        Peminjaman::where('id', $request->id)->update([
            'tgl_pinjam' => $request->tgl_pinjam,
            'total' => $request->total - count($request->barang_id)
        ]);
        for($i = 0; $i < count($request->barang_id); $i++)
        {
            Barang::where('id', $request->barang_id[$i])->update(['status' => 'tersedia']);
            PeminjamanDetail::where('peminjam_id', $request->id)
                                ->where('barang_id', $request->barang_id[$i])
                                ->delete();
        }
        return redirect('pegawai/peminjams')->with('success', 'Berhasil Ubah Peminjaman');
    }

    public function history()
    {
        return view('pegawai/peminjaman/history', [
            'peminjaman' => Peminjaman::where(function($query){
                                $query->where('status', 'dibatalkan')
                                ->orWhere('status', 'sudah kembali');
                            })
                            ->where('user_id', auth()->user()->id)
                            ->get()
        ]);
    }
}
