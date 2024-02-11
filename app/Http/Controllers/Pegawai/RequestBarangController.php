<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\RequestBarang;
use Illuminate\Http\Request;

class RequestBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataRequestBarang = RequestBarang::where('user_id', auth()->user()->id)->get();

        return view('pegawai/request-barang/index', [
            'requestBarangs' => $dataRequestBarang
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pegawai/request-barang/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kategori_id' => 'required',
            'barang_name' => 'required'
        ]);
        $validatedData['status'] = 'pengajuan';
        $validatedData['user_id'] = auth()->user()->id;

        RequestBarang::create($validatedData);

        return redirect('/pegawai/request-barangs')->with('success', 'Berhasil Menambahkan Request Barang');
    }

    /**
     * Display the specified resource.
     */
    public function show(RequestBarang $requestBarang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RequestBarang $requestBarang)
    {
        return view('pegawai/request-barang/edit', [
            'requestBarang' => $requestBarang
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RequestBarang $requestBarang)
    {
        $validatedData = $request->validate([
            'kategori_id' => 'required',
            'barang_name' => 'required'
        ]);

        RequestBarang::where('id', $requestBarang->id)->update($validatedData);
        
        return redirect('/pegawai/request-barangs')->with('success', 'Berhasil Mengedit Request Barang');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RequestBarang $requestBarang)
    {
        RequestBarang::destroy($requestBarang->id);
        return redirect('/pegawai/request-barangs')->with('success', 'Berhasil Menghapus Request Barang');
    }
}
