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
use PhpParser\Node\Stmt\Return_;

class PengadaanController extends Controller
{
    public function index()
    {
        $dataBarang = Barang::where(function($query){
            $query->where('kondisi', 'like', 'hilang')
            ->orWhere('status', 'like', 'rusak');
        })->get();

        $dataPengadaan = Pengadaan::with('pengadaan_detail')->where(function($query){
            $query->where('status', 'like', 'pengajuan');
        })->get();

        return view('pengadaan/index', [
            'barangs' => $dataBarang,
            'pengadaans' => $dataPengadaan,
        ]);
    }

    public function create()
    {
        $dataBarang = Barang::where(function($query){
            $query->where('kondisi', 'like', 'hilang')
            ->orWhere('status', 'like', 'rusak');
        })->get();

        return view('pengadaan/create', [
            'user' => auth()->user(),
            'barangs' => $dataBarang,
            'no_surat' => $this->createNoSurat()
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
        $dataPengadaan = Pengadaan::with('barang', 'pengadaan_detail')->findOrFail($id);
        
        return view('pengadaan/show', [
            'pengadaan' => $dataPengadaan
        ]);
    }

    public function setujui($id)
    {
        $dataPengadaan = Pengadaan::with('barang', 'pengadaan_detail')->find($id);
        // return $dataPengadaan;
        return view("pengadaan/setujui-pengadaan", [
            'pengadaan' => $dataPengadaan
        ]);
        // return $id;
        // $pengadaan = Pengadaan::findOrFail($id);
        // $pengadaan->status = "disetujui";
        // $pengadaan->save();
        // return redirect('/pengadaans')->with('success', 'Pengadaan Berhasil Disetujui');
    }

    public function simpanPersetujuan(Request $request) 
    {
        // return $request;
        if($request->pengadaan_detail_id != null) {
            $result = array_diff($request->pengadaan_detail_id_semua, $request->pengadaan_detail_id);
            // return $result;
            if ($result != null) {
                // return $result;
                PengadaanDetail::destroy($result);
            }
            // return "disetujui semua";
            Pengadaan::where('id', $request->pengadaan_id)->update([
                'status' => 'disetujui'
            ]);

            return redirect('/pengadaan/disetujui')->with('success', 'Pengadaan Berhasil Disetujui');

        } elseif ($request->barang_name != null) {
            // return "pengadaan yang biasa";
            for ($i = 0; $i < count($request->pengadaan_detail_id_biasa); $i++) {
                PengadaanDetail::where('id', $request->pengadaan_detail_id_biasa[$i])->update([
                    'jumlah' => $request->jumlah[$i]
                ]);

                PengadaanDetail::where('id', $request->pengadaan_detail_id_biasa[$i])->where('jumlah', 0)->delete();
            }
            Pengadaan::where('id', $request->pengadaan_id)->update([
                'status' => 'disetujui'
            ]);
            return redirect('/pengadaan/disetujui')->with('success', 'Pengadaan Berhasil Disetujui');
        }

        return back()->with("success", "Ceklis terlebih dahulu atau kembali untuk tolak pengajuan");

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
            $query->where('status', 'like','')
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
    }

    public function storeKwitansi(Request $request)
    {
        // return $request->jumlah;
        $validatedData = $request->validate([
            'kwitansi' => 'required|file',
            'tgl_beli' => 'required'
        ]);
        $validatedData['pengadaan_id']= $request->pengadaan_id;

        $file = $request->file('kwitansi');

        if ($request->barang_id === null){
            // create table barang
            // return "store barang baru";
            for ($i = 0; $i < count($request->barang_name); $i++){
                $dataKategori = Kategori::with('jurusan')->find($request->kategori_id[$i]);

                // return $dataKategori->jurusan->jurusan_code;
                $kodeJurusan = $dataKategori->jurusan->jurusan_code;
                $kodeKategori = $dataKategori->kategori_code;

                for ($j= 0; $j < $request->jumlah[$i]; $j++) {
                    $noUrutAkhir = Barang::max('id');
                    $no = "".$noUrutAkhir + 1;
    
                    $kodeBarangFix = $kodeJurusan. '/'. $kodeKategori. '/'. $no++;
                    
                    Barang::create([
                        'kategori_id' => $request->kategori_id[$i],
                        'barang_code' => $kodeBarangFix,
                        'barang_name' => $request->barang_name[$i],
                        'tgl_masuk' => $request->tgl_beli,
                        'status' => 'tersedia',
                        'kondisi' => 'baik'
                    ]);
                }
            }
        } else {
            //update table barang
            // return "update barang";
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
        }

        //store ke table kwitansi
        $validatedData['file_name'] = $file->getClientOriginalName();
        $validatedData['file_type'] = $file->getMimeType();
        $validatedData['size'] = $file->getSize();
        $validatedData['path'] = $file->store('toPath', ['disk' => 'public_uploads_kwitansi']);
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

    public function pengadaanHistory()
    {
        $dataPengadaan = Pengadaan::all();
        // return $dataPengadaan;
        return view("pengadaan/history", [
            'pengadaans' => $dataPengadaan
        ]);
    }

    public function tambah()
    {
        return view('pengadaan/tambah', [
            'kategoris' => Kategori::all(),
            'no_surat' => $this->createNoSurat(),
            'user' => auth()->user()
        ]);
    }

    public function simpan(Request $request)
    {
        // return $request;
        $validatedData = $request->validate([
            'user_id' => 'required',
            'no_surat' => 'required',
            'tgl_pengajuan' => 'required',
            'status' => 'required'
        ]);

        $newPengadaan = Pengadaan::create($validatedData);

        for($i = 0; $i < count($request->kategori_id); $i++){
            PengadaanDetail::create([ 
                'pengadaan_id' => $newPengadaan->id,
                'barang_name' => $request->barang_name[$i],
                'kategori_id' => $request->kategori_id[$i],
                'jumlah' => $request->jumlah[$i],
            ]);
        }

        return redirect('pengadaans')->with('success', 'Berhasil mengajukan Pengadaan');
    }

    public function createNoSurat()
    {
        //nomor surat       
        $tahun = Carbon::now('Y');
        $AWAL = 'PGB';
        $bulanRomawi = array("", "I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
        $noUrutAkhir = Pengadaan::max('id');
        $no = "0".$noUrutAkhir + 1;
        $no_surat = $no . '/' . $AWAL . '/' . $bulanRomawi[date('n')] . '/' . $tahun->year;

       return $no_surat;
    }
}