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
        return view('peminjaman/create', [
            'pegawai' => User::where('role_id', 4)->get(),
            'barangs' => Barang::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'status' => 'required',
        ]);
        $validatedData['tgl_pinjam'] = Carbon::now()->format('Y-m-d');
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
        $peminjamanDetail = PeminjamanDetail::findOrFail($id);
        Barang::where('id', $peminjamanDetail->barang_id)
                ->update([
                    'status' => 'tersedia'
                ]);
        Peminjaman::destroy($id);
        PeminjamanDetail::destroy($id);

        return redirect('/peminjams')->with('success', 'Peminjaman Berhasil Dibatalkan');
    }
}
