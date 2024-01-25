<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangTidakDipakai;
use App\Models\Jurusan;
use App\Models\Kategori;
use App\Models\Kwitansi;
use App\Models\Pengadaan;
use App\Models\PengadaanDetail;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PengadaanController extends Controller
{
    public function index()
    {
        $dataBarang = Barang::where(function($query){
            $query->where('kondisi', 'like', 'hilang')
            ->orWhere('status', 'like', 'rusak');
        })->get();

        $dataPengadaan = Pengadaan::where(function($query){
            $query->where('status', 'like', 'pengajuan');
        })->get();

        return view('pengadaan/index', [
            'barangs' => $dataBarang,
            'pengadaans' => $dataPengadaan,
        ]);
    }

    public function create()
    {
        //nomor surat       
        $tahun = Carbon::now('Y');
        $AWAL = 'PGB';
        $bulanRomawi = array("", "I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
        $noUrutAkhir = Pengadaan::max('id');
        $no = "0".$noUrutAkhir + 1;
        $no_surat = $no . '/' . $AWAL . '/' . $bulanRomawi[date('n')] . '/' . $tahun->year;

        $dataBarang = Barang::where(function($query){
            $query->where('kondisi', 'like', 'hilang')
            ->orWhere('status', 'like', 'rusak');
        })->get();

        return view('pengadaan/create', [
            'user' => auth()->user(),
            'barangs' => $dataBarang,
            'no_surat' => $no_surat
        ]);
    }

    public function store(Request $request)
    {
        if ($request->barang_id === null){
            return back()->with("success", "Pilih Barang Terlebih Dahulu");
        }
        // return $request;

        $validatedData = $request->validate([
            'user_id' => 'required',
            'no_surat' => 'required',
            'tgl_pengajuan' => 'required',
            'status' => 'required'
        ]);

        $newPengadaan = Pengadaan::create($validatedData);

        for($i = 0; $i < count($request->barang_id); $i++)
        {
            PengadaanDetail::create([ 
                'pengadaan_id' => $newPengadaan->id,
                'barang_id' => $request->barang_id[$i],
            ]);
        }
        return redirect('pengadaans')->with('success', 'Berhasil Mengajukan Pengadaan');
    }

    public function show($id)
    {
        $dataPengadaan = Pengadaan::findOrFail($id);

        return view('pengadaan/show', [
            'pengadaan' => $dataPengadaan
        ]);
    }

    public function setujui($id)
    {
        $pengadaan = Pengadaan::findOrFail($id);
        $pengadaan->status = "disetujui";
        $pengadaan->save();

        return redirect('/pengadaans')->with('success', 'Pengadaan Berhasil Disetujui');
    }

    public function tolak($id)
    {
        $pengadaan = Pengadaan::findOrFail($id);
        $pengadaan->status = "ditolak";
        $pengadaan->save();

        return redirect('/pengadaans')->with('success', 'Pengadaan Berhasil Ditolak');
    }

    public function pengadaanDisetujui()
    {
        $dataPengadaan = Pengadaan::where(function($query){
            $query->where('status', 'like', 'ditolak')
            ->orWhere('status', 'like', 'disetujui');
        })->get();

        return view('pengadaan/disetujui', [
            'pengadaans' => $dataPengadaan
        ]);
    }

    public function createKwitansi($id)
    {
        $dataPengadaan = Pengadaan::with('barang')->findOrFail($id);
        
        return view('pengadaan/upload-kwitansi', [
            'pengadaan' => $dataPengadaan
        ]);
        return $id;
    }

    public function storeKwitansi(Request $request)
    {
        // return $request;
        $validatedData = $request->validate([
            'kwitansi' => 'required|file',
            'tgl_beli' => 'required'
        ]);
        $validatedData['pengadaan_id']= $request->pengadaan_id;

        $file = $request->file('kwitansi');
        
        $validatedData['file_name'] = $file->getClientOriginalName();
        $validatedData['file_type'] = $file->getMimeType();
        $validatedData['size'] = $file->getSize();
        $validatedData['path'] = $file->store('toPath', ['disk' => 'public_uploads_kwitansi']);


        //update table barang
        for($i = 0; $i < count($request->barang_id); $i++) {
            Barang::where('id', $request->barang_id[$i])->update([
                'status' => 'tersedia',
                'kondisi' => 'baik'
            ]);
            
            BarangTidakDipakai::create([
                'barang_name' => $request->barang_name[$i],
                'kategori_id' => $request->kategori_id[$i],
                'tgl_masuk' => now()
            ]);
        }

        //store ke table kwitansi
        Kwitansi::create($validatedData);

        //update table pengadaan
        Pengadaan::where('id', $request->pengadaan_id)->update([
            'status' => 'sudah dibeli'
        ]);

        return redirect('/pengadaan/dibeli')->with('success', 'Berhasil upload kwitansi');

    }

    public function pengadaanDibeli()
    {
        $dataPengadaan = Pengadaan::with('kwitansi')->where('status', 'sudah dibeli')->get();
        
        return view('pengadaan/sudah-dibeli', [
            'pengadaans' => $dataPengadaan
        ]);
    }
}