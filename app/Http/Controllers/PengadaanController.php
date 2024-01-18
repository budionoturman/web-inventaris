<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class PengadaanController extends Controller
{
    public function index()
    {
        $dataBarang = Barang::where(function($query){
            $query->where('kondisi', 'like', 'hilang')
            ->orWhere('status', 'like', 'rusak');
        })->get();

        return view('pengadaan/index', [
            'barangs' => $dataBarang
        ]);
    }

    public function create()
    {
        return 'create';
    }
}
