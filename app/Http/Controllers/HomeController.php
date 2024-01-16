<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Jurusan;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $dataJurusan =  Jurusan::with('barang')->withCount('barang')->get();
        $idTkj = Jurusan::where('jurusan_name','LIKE', '\\'. 'Teknik Komputer dan Jaringan'. '%')->value('id');
        $idTo = Jurusan::where('jurusan_name','LIKE', '\\'. 'Teknik Otomotif'. '%')->value('id');
        $idMm = Jurusan::where('jurusan_name','LIKE', '\\'. 'Multimedia'. '%')->value('id');

        $jumlahTkj = $dataJurusan->where('id', $idTkj)->value('barang_count');
        $jumlahTo = $dataJurusan->where('id', $idTo)->value('barang_count');
        $jumlahMm = $dataJurusan->where('id', $idMm)->value('barang_count');


        return view('index',[
            'barangs' => Barang::where('status', 'like', "tersedia")->get(),
            'peminjamans' => Peminjaman::all(),
            'jumlahTkj' => $jumlahTkj,
            'jumlahTo' => $jumlahTo,
            'jumlahMm' => $jumlahMm,
        ]);
    }
}
