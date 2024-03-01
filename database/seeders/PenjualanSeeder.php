<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=[
            [
                'penjualan_id' => 1,
                'user_id' => 3,
                'pembeli' => 'Delinda',
                'penjualan_kode' => 'trnsks1',
                'penjualan_tanggal' => Carbon::now()
            ],
            [
                'penjualan_id' => 2,
                'user_id' => 3,
                'pembeli' => 'Candrawati',
                'penjualan_kode' => 'trnsks2',
                'penjualan_tanggal' => Carbon::now()
            ],
            [
                'penjualan_id' => 3,
                'user_id' => 3,
                'pembeli' => 'Eka',
                'penjualan_kode' => 'trnsks3',
                'penjualan_tanggal' => Carbon::now()
            ],
            [
                'penjualan_id' => 4,
                'user_id' => 3,
                'pembeli' => 'Putri',
                'penjualan_kode' => 'trnsks4',
                'penjualan_tanggal' => Carbon::now()
            ],
            [
                'penjualan_id' => 5,
                'user_id' => 3,
                'pembeli' => 'Fakhril',
                'penjualan_kode' => 'trnsks5',
                'penjualan_tanggal' => Carbon::now()
            ],
            [
                'penjualan_id' => 6,
                'user_id' => 3,
                'pembeli' => 'Fahreza',
                'penjualan_kode' => 'trnsks6',
                'penjualan_tanggal' => Carbon::now()
            ],
            [
                'penjualan_id' => 7,
                'user_id' => 3,
                'pembeli' => 'Tsaqib',
                'penjualan_kode' => 'trnsks7',
                'penjualan_tanggal' => Carbon::now()
            ],
            [
                'penjualan_id' => 8,
                'user_id' => 3,
                'pembeli' => 'Widya',
                'penjualan_kode' => 'trnsks8',
                'penjualan_tanggal' => Carbon::now()
            ],
            [
                'penjualan_id' => 9,
                'user_id' => 3,
                'pembeli' => 'Muin',
                'penjualan_kode' => 'trnsks9',
                'penjualan_tanggal' => Carbon::now()
            ],[
                'penjualan_id' => 10,
                'user_id' => 3,
                'pembeli' => 'Cathy',
                'penjualan_kode' => 'trnsks10',
                'penjualan_tanggal' => Carbon::now()
            ],
        ];
            DB::table('t_penjualan')->insert($data);
    }
}
