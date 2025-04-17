<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SekolahFormalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama_sekolah' => 'SMA Negeri 1 Jakarta',
                'alamat' => 'Jl. Merdeka No. 10, Jakarta',
                'jenjang' => 'SLTA',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_sekolah' => 'SMP Negeri 3 Bandung',
                'alamat' => 'Jl. Asia Afrika No. 25, Bandung',
                'jenjang' => 'SLTP',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_sekolah' => 'Universitas Gadjah Mada',
                'alamat' => 'Bulaksumur, Yogyakarta',
                'jenjang' => 'Perguruan Tinggi',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('sekolah_formals')->insert($data);
    }

    
}
