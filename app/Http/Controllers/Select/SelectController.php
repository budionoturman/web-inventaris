<?php

namespace App\Http\Controllers\Select;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Jurusan;
use App\Models\Kategori;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class SelectController extends Controller
{
    public function getrole(Request $request)
    {
        $role = [];
     //   console.log("jim");
        if($request->has('q')){
            $search = $request->q;
            $role =Role::select("id", "role_name")
                    ->where('role_name', 'LIKE', "%$search%")
                    ->get();
        }else{ 
            $role =Role::select("id", "role_name")->orderBy('id')->get();
        }
        return response()->json($role);
    }

    public function getjurusan(Request $request)
    {
        $jurusan = [];
        if($request->has('q')){
            $search = $request->q;
            $jurusan =Jurusan::select("id", "jurusan_name")
                    ->where('jurusan_name', 'LIKE', "%$search%")
                    ->get();
        }else{ 
            $jurusan =Jurusan::select("id", "jurusan_name")->orderBy('id')->get();
        }
        return response()->json($jurusan);
    }

    public function getkategori(Request $request)
    {
        $kategori = [];
        if($request->has('q')){
            $search = $request->q;
            $kategori =Kategori::select("id", "kategori_name")
                    ->where('kategori_name', 'LIKE', "%$search%")
                    ->get();
        }else{ 
            $kategori =Kategori::select("id", "kategori_name")->orderBy('id')->get();
        }
        return response()->json($kategori);
    }

    public function getpegawai(Request $request)
    {
        $pegawai = [];
        if($request->has('q')){
            $search = $request->q;
            $pegawai = User::select("id", "name")
                    ->where('name', 'LIKE', "%$search%")
                    ->get();
        }else{ 
            $pegawai = User::select("id", "name")->orderBy('id')->get();
        }
        return response()->json($pegawai);
    }

    public function getbarang(Request $request)
    {
        $barang = [];
        if($request->has('q')){
            $search = $request->q;
            $barang =Barang::select("id", "barang_name")
                    ->where('status', 'tersedia')
                    ->where('barang_name', 'LIKE', "%$search%")
                    ->get();
        }else{ 
            $barang =Barang::select("id", "barang_name")->orderBy('id')
                    ->where('status', 'tersedia')
                    ->get();
        }
        return $barang;
        return response()->json($barang);

    }
}
