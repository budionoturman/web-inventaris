<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('jurusan/index',[
            'jurusans' => Jurusan::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'jurusan_name' => 'required',
            'jurusan_code' => 'required',
        ]);

        Jurusan::create($validateData);
        return redirect('jurusans')->with('success', 'Berhasil Tambah Jurusan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jurusan $jurusan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jurusan $jurusan)
    {
        return view('jurusan/edit',[
            'jurusan' => $jurusan
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jurusan $jurusan)
    {
        $validateData = $request->validate([
            'jurusan_name' => 'required',
            'jurusan_code' => 'required',
        ]);

        Jurusan::where('id', $jurusan->id)->update($validateData);
        return redirect('jurusans')->with('success', 'Berhasil Update Jurusan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jurusan $jurusan)
    {
        Jurusan::destroy($jurusan->id);
        return redirect('jurusans')->with('success', 'Jurusan Berhasil Dihapus');
    }
}
