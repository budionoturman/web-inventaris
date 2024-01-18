<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class KondisiBarangController extends Controller
{
    public function index() 
    {
        $dataBarang = Barang::where(function($query){
                        $query->where('kondisi', 'like', 'rusak')
                        ->orWhere('kondisi', 'like', 'rusak berat');
                    })->get();

        return view('kondisi-barang/index', [
            'barangs' => $dataBarang
        ]);
    }

    public function perbaikan($id)
    {
        $dataBarang = Barang::findOrFail($id);

        return view('kondisi-barang/perbaikan', [
            'barangs' => $dataBarang
        ]);
    }

    public function saveperbaikan(Request $request, $id)
    {
        $validatedData = $request->validate([
            'barang_name' => 'required',
            'barang_code' => 'required',
            'kategori_id' => 'required',
            'kondisi' => 'required',
        ]);

        Barang::where('id', $id)->update($validatedData);
        return redirect('kondisi-barangs')->with('success', 'Berhasil Update Barang');
    }

    public function tidakperbaikan($id)
    {
        $dataBarang = Barang::findOrFail($id);
        return view('kondisi-barang/tidak-perbaikan', [
            'barangs' => $dataBarang
        ]);
    }

    public function pengadaan(Request $request, $id)
    {
        return $id;
    }
}
