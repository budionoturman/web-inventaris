<?php

namespace App\Console\Commands;

use App\Models\Barang;
use App\Models\Peminjaman;
use Illuminate\Console\Command;

class CheckExpiredPeminjaman extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-expired-peminjaman';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dateYesterday = now()->modify('-1 day');
        $peminjamans = Peminjaman::query()
                        ->with('barang')
                        ->where('status', 'proses')
                        ->where('tgl_pinjam', '<', $dateYesterday)
                        ->first();
        $peminjamans->update(['status' => 'dibatalkan']);

        for($i = 0; $i < count($peminjamans->barang); $i++) {
           Barang::where('id', $peminjamans->barang[$i]->id)
                    ->update(['status' => 'tersedia']);
        }
    }
}
