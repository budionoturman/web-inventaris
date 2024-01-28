<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('kategori/index',[
            'kategoris' => Kategori::all(),
            'jurusans' => Jurusan::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jurusan = Jurusan::all();
        return view('kategori/create', [
            'jurusans' => $jurusan
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'kategori_name' => 'required',
            'kategori_code' => 'required|unique:kategoris',
            'jurusan_id' => 'required',
        ]);

        Kategori::create($validateData);
        return redirect('kategoris')->with('success', 'Berhasil Tambah kategori');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        return view('kategori/edit', [
            'kategori' => $kategori,
            'jurusans' => Jurusan::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        $validateData = $request->validate([
            'kategori_name' => 'required',
            'kategori_code' => 'required',
            'jurusan_id' => 'required',
        ]);

        Kategori::where('id', $kategori->id)->update($validateData);
        return redirect('kategoris')->with('success', 'Berhasil Update kategori');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        Kategori::destroy($kategori->id);
        return redirect('kategoris')->with('success', 'Kategori Berhasil Dihapus');
    }
}
