<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('barangs')->insert([
            [
                'barang_code' => 'TK/RTR/1',
                'barang_name' => 'TP-LINK GRID',
                'status' => 'tersedia',
                'kondisi' => 'baik',
                'tgl_masuk' => Carbon::now()->format('Y-m-d'),
                'kategori_id' => '3',
                'spesifikasi' => 'Dimensi 1000mm x 600mm, Weight 3.5kg, Frekuensi 2.4GHz, Gain 24dBi, VSWR (MAX.) 1.5:1, HPBW/H( ) 10, HPBW/V( ) 14, Polarisasi Linear; Vertocal,  Tipe Directional, Tipe Konektor N Female(Jack), Perpanjangan Kabel 30cm, Mount Pole Mount, Aplikasi Outdoor, Perkiraan Jarak dMbps 56km/31.5km/4.44km',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'barang_code' => 'TK/RTR/2',
                'barang_name' => 'TP-LINK OMNI',
                'status' => 'tersedia',
                'kondisi' => 'baik',
                'tgl_masuk' => Carbon::now()->format('Y-m-d'),
                'kategori_id' => '3',
                'spesifikasi' => 'Weight 0.6kg, Frequency 2.4GHz~2.5GHz, Impedance	50 Ohms, Gain	15 dBi, Radiation	Omni-directional, VSWR(MAX.)	< 2.0, HPOL Beamwidth	360°, VPOL Beamwidth	9°, Polarization	Linear, Vertical, Mounting	Pole Mount / Wall Mount, Application	Outdoor, Lightning Protection	DC Ground, Operating Temp.	-40℃~65℃(-40℉~149℉), Storage Temp.	-40℃~80℃ (-40℉~176℉), Operating Humidity	10%~90% non-condensing, Storage Humidity	5%~90% non-condensing
                Safety, Emission and Others	CE, FCC, Compliant with RoHS, Package Contents	15dBi Outdoor Omni-directional Antenna, Installation mounting kits, Dimension	1500mm',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'barang_code' => 'TK/RTR/3',
                'barang_name' => 'TP-LINK 2,4 GHZ',
                'status' => 'tersedia',
                'kondisi' => 'baik',
                'tgl_masuk' => Carbon::now()->format('Y-m-d'),
                'kategori_id' => '3',
                'spesifikasi' => 'Processor	Qualcomm Atheros 560MHz CPU, MIPS 24Kc
                Memory	64MB DDR2 RAM, 8MB Flash
                Interface	1 10/100Mbps Shielded Ethernet Port (LAN0,Passive PoE in)
                1 10/100Mbps Shielded Ethernet Port (LAN1)
                1 Grounding Terminal
                1 Reset Button
                Power Supply	Passive Power over Ethernet via LAN0 (+4,5pins; -7,8pins)
                Voltage range: 16-27VDC
                Power Consumption	10.8 Watts Max
                Note: When deployed using Passive PoE, the power drawn from the power source will
                be higher by some amount depending on the length of the connecting cable.
                Dimensions ( W x D x H )	11x3.1x2.1 inch (276x79x60 mm)
                Antenna Type	Built-in 12dBi 2x2 Dual-polarized Directional Antenna
                Beam Width: 60° (H-Plane) / 30° (E-Plane)
                Note: For more details, please refer to datasheet
                Protection	15KV ESD Protection
                6KV Lightning Protection
                Enclosure	Outdoor ASA stabilized plastic material
                IPX5 waterproof Certification',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        for($i = 4; $i < 14; $i++) {
            Barang::create([
                'barang_code' => 'TK/SWC/'.$i,
                'barang_name' => 'TP-LINK SWITCH 5 PORT',
                'status' => 'tersedia',
                'kondisi' => 'baik',
                'tgl_masuk' => Carbon::now()->format('Y-m-d'),
                'kategori_id' => '4',
                'spesifikasi' => 'Interface	5 10/100Mbps RJ45 Ports
                AUTO Negotiation/AUTO MDI/MDIX
                Fan Quantity	Fanless
                External Power Supply	External Power Adapter(Output: 5.0VDC / 0.6A)
                Dimensions ( W x D x H )	4.1 x 2.8 x 0.9 in. (103.5 x 70 x 22 mm)
                Max Power Consumption	1.87W(220V/50Hz)
                Max Heat Dissipation	6.38BTU/h',
            ]);
        }
        
        for($i = 14; $i < 19; $i++) {
            Barang::create([
                'barang_code' => 'TK/SWC/'.$i,
                'barang_name' => 'TP-LINK SWITCH 8 PORT',
                'status' => 'tersedia',
                'kondisi' => 'baik',
                'tgl_masuk' => Carbon::now()->format('Y-m-d'),
                'kategori_id' => '4',
                'spesifikasi' => 'Standards and Protocols	IEEE 802.3, IEEE 802.3u, IEEE 802.3x
                CSMA/CD
                Interface	8 10/100Mbps Ports, Auto-Negotiation, Auto-MDI/MDIX
                Fan Quantity	Fanless
                Power Supply	External Power Adapter(Output: 5.0VDC / 0.6A)
                External Power Supply	100-240VAC, 50/60Hz
                Buffer Size	768Kb
                Data Rates	10/100Mbps at Half Duplex ;
                20/200Mbps at Full Duplex
                LED Indicator	Power, 1, 2, 3, 4, 5, 6, 7, 8
                Dimensions ( W x D x H )	5.3*3.1*0.9 in. (134.5*79*22.5mm)
                Max Power Consumption	2.05W(220V/50Hz)
                Max Heat Dissipation	6.99BTU/h',
            ]);
        }

        for($i = 19; $i < 30; $i++) {
            Barang::create([
                'barang_code' => 'TK/SWC/'.$i,
                'barang_name' => 'D-LINK WIRELES N 150 MBPS',
                'status' => 'tersedia',
                'kondisi' => 'baik',
                'tgl_masuk' => Carbon::now()->format('Y-m-d'),
                'kategori_id' => '4',
                'spesifikasi' => 'Connection IEEE 802.11b/g/n
                Frequency 2.4 GHz to 2.4835 GHz
                Software Support Windows XP SP3, Vista, 7, 8
                Dimension 65 x 23 x 12 mm (2.6 x 0.9 x 0.5 inches)
                Others Antenna: Integrated antenna',
            ]);
        }

        Barang::create([
            'barang_code' => 'TK/SWC/30',
            'barang_name' => 'D-LINK SWITCH DES-1024A 24 PORT',
            'status' => 'tersedia',
            'kondisi' => 'baik',
            'tgl_masuk' => Carbon::now()->format('Y-m-d'),
            'kategori_id' => '4',
            'spesifikasi' => '• IEEE 802.3 10Base-T Ethernet (twisted-pair)
            • IEEE 802.3u 100BASE-TX Fast Ethernet (twistedpair)
            • Ethernet IEEE 802.3az Energi-Efisien (EEE)
            • ANSI/IEEE 802.3 auto-negosiasi 
            • instalasi Plug-and-play
            • Full/half-duplex untuk kecepatan Ethernet/Fast Ethernet
            • IEEE 802.3x Flow Control',
        ]);

        for($i = 31; $i < 36; $i++) {
            Barang::create([
                'barang_code' => 'TK/RTR/'.$i,
                'barang_name' => 'MIKROTIK ROUTERBOARD 750',
                'status' => 'tersedia',
                'kondisi' => 'baik',
                'tgl_masuk' => Carbon::now()->format('Y-m-d'),
                'kategori_id' => '3',
                'spesifikasi' => 'RB750 adalah produk routerboard yang sangat mungil dan diperuntukkan bagi penggunaan SOHO. Memiliki 5 buah port ethernet 10/100, dengan prosesor baru Atheros 400MHz. Sudah termasuk dengan lisensi level 4 dan adaptor 12V.',
            ]);
        }
        
        for($i = 36; $i < 46; $i++) {
            Barang::create([
                'barang_code' => 'TK/RTR/'.$i,
                'barang_name' => 'MIKROTIK ROUTERBOARD 941',
                'status' => 'tersedia',
                'kondisi' => 'baik',
                'tgl_masuk' => Carbon::now()->format('Y-m-d'),
                'kategori_id' => '3',
                'spesifikasi' => 'RB941-2nD memiliki semua kebutuhan router dan gateway untuk segala kondisi jaringan. Memiliki 4 buah port ethernet, 1 buah access point embedded 2,4 GHz, antenna embedded 2x1,5 dbi. Sudah termasuk power adaptor.',
            ]);
        }

        for($i = 46; $i < 76; $i++) {
            Barang::create([
                'barang_code' => 'TK/MNR/'.$i,
                'barang_name' => 'LAYAR MONITOR LG',
                'status' => 'tersedia',
                'kondisi' => 'baik',
                'tgl_masuk' => Carbon::now()->format('Y-m-d'),
                'kategori_id' => '2',
                'spesifikasi' => 'Ukuran (Inci / cm) : 18.5" / 47cm
                Jenis Panel : TN
                Rasio Aspek : 16:09
                Resolusi 1366 x 768
                Kecerahan ((Umum)) : 200 cd/m²
                D-Sub : Ya
                KONSUMSI
                Normal Hidup (EPA) : 13W
                Normal Hidup (typ.) : 18W
                Koreksi Warna: YA
                Flicker Aman : Ya
                Hemat Listrik Cerdas : Ya
                Layar belah 4: YA
                Kontrol Pada Layar : Ya',
            ]);
        }
    }
}
