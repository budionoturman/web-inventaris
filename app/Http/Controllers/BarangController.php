<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Jurusan;
use App\Models\Kategori;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('barang/index', [
            'barangs' => Barang::all(),
            'jurusans' => Jurusan::all(),
            'kategoris' => Kategori::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barang/create', [
            'kategoris' => Kategori::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //create code barang start
        $getkategoriData = Kategori::where('id', $request->kategori_id)->first();
        $getJurusanData = Jurusan::where('id', $getkategoriData->jurusan_id)->first();

        $kodeJurusan = $getJurusanData->jurusan_code;
        $kodekategori = $getkategoriData->kategori_code;

        $noUrutAkhir = Barang::max('id');
        $no = "".$noUrutAkhir + 1;

        $kodeBarangFix = $kodeJurusan. '/'. $kodekategori. '/'. $no;
        //create code barang end

        $validatedData = $request->validate([
            'kategori_id' => 'required',
            'barang_name' => 'required'
        ]);

        $validatedData['barang_code'] = $kodeBarangFix;
        $validatedData['status'] = 'tersedia';
        $validatedData['kondisi'] = 'baik';
        $validatedData['tgl_masuk'] = Carbon::now()->format('Y-m-d');

        Barang::create($validatedData);
        return redirect('barangs')->with('success', 'Berhasil Menambahkan Barang');
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        return view('barang/edit', [
            'barangs' => $barang,
            'kategoris' => Kategori::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang)
    {
        $validatedData = $request->validate([
            'barang_name' => 'required',
            'barang_code' => 'required',
            'kategori_id' => 'required',
            'status' => 'required',
            'kondisi' => 'required',
        ]);

        Barang::where('id', $barang->id)->update($validatedData);
        return redirect('barangs')->with('success', 'Berhasil Update Barang');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        Barang::destroy($barang->id);
        return redirect('barangs')->with('success', 'Berhasil Menghapus Barang');
    }


    public function stok() 
    {
        return view('barang/stok');
    }
}
