<?php

namespace App\Http\Controllers;

use App\Models\RequestBarang;
use Illuminate\Http\Request;

class RequestBarangMasukController extends Controller
{
    public function index()
    {
        $dataRequestBarang = RequestBarang::all();

        return view('request-barang-masuk/index', [
            'requestBarangs' => $dataRequestBarang
        ]);
    }

    public function edit($id)
    {
        $dataRequestBarang = RequestBarang::findorFail($id);
        
        return view('request-barang-masuk/edit', [
            'requestBarangs' => $dataRequestBarang
        ]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'barang_name' => 'required',
            'kategori_id' => 'required',
            'status' => 'required'
        ]);

        RequestBarang::where('id', $id)->update($validatedData);

        return redirect('/request-barang-masuk')->with('success', 'Berhasil Ubah Status Request Barang Masuk');
    }

    public function delete($id)
    {
        RequestBarang::destroy($id);
        return redirect('/request-barang-masuk')->with('success', 'Berang dihapus');
        
    }
}
