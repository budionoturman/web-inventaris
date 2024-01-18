<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\PeminjamanDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use GuzzleHttp\Promise\Create;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peminjaman = Peminjaman::all();
        return view('peminjaman/index', [
            'peminjamans' => Peminjaman::where('status', 'like', 'proses')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dataBarang = Barang::where('status', 'LIKE', 'tersedia')
                    ->where('kondisi', 'LIKE', 'baik')
                    ->get();
                    
        return view('peminjaman/create', [
            'pegawai' => User::where('role_id', 4)->get(),
            'barangs' => $dataBarang,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
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

        return redirect('peminjams')->with('success', 'Berhasil Menambahkan Peminjaman');
    }

    /**
     * Display the specified resource.
     */
    public function show(Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Peminjaman $peminjaman)
    {
        //
    }

    public function proses($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->status = "belum kembali";
        $peminjaman->save();

        return redirect('/peminjams')->with('success', 'Peminjaman Berhasil Diproses');
    }

    public function batalkan($id)
    {
        $peminjaman = Peminjaman::with('peminjaman_detail')->where('id', $id)->first();
        
        for($i = 0; $i < count($peminjaman->peminjaman_detail); $i++)
        {
            Barang::where('id', $peminjaman->peminjaman_detail[$i]->barang_id)
                    ->update(['status' => 'tersedia']);
        }
        Peminjaman::destroy($id);
        PeminjamanDetail::destroy('peminjam_id', $id);

        return redirect('/peminjams')->with('success', 'Peminjaman Berhasil Dibatalkan');
    }
}
