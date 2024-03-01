<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=[
            [
                'barang_id' => 1,
                'kategori_id' => 1,
                'barang_kode' => 'wfrSlmt',
                'barang_nama' => 'Selamat Wafer Chocolate Cream 145g',
                'harga_beli' => 12000,
                'harga_jual' => 15000,
            ],
            [
                'barang_id' => 2,
                'kategori_id' => 1,
                'barang_kode' => 'sariRoti',
                'barang_nama' => 'Sari Roti Tawar Jumbo Special',
                'harga_beli' => 15000,
                'harga_jual' => 18000,
            ],
            [
                'barang_id' => 3,
                'kategori_id' => 2,
                'barang_kode' => 'kopken',
                'barang_nama' => 'Kopi Kenangan Hanya Untukmu 200ml',
                'harga_beli' => 5000,
                'harga_jual' => 7500,
            ],
            [
                'barang_id' => 4,
                'kategori_id' => 2,
                'barang_kode' => 'sucim',
                'barang_nama' => 'Cimory Fresh Milk UHT CHoco Malt 250ml',
                'harga_beli' => 10000,
                'harga_jual' => 12000,
            ],
            [
                'barang_id' => 5,
                'kategori_id' => 3,
                'barang_kode' => 'ksmtkemina',
                'barang_nama' => 'Emina Beauty Bliss Bb Cream Natural 20ml',
                'harga_beli' => 30000,
                'harga_jual' => 36200,
            ],
            [
                'barang_id' => 6,
                'kategori_id' => 3,
                'barang_kode' => 'skncrHL',
                'barang_nama' => 'Hada Labo Gokujyun Ultimate Moisturizing Milk 100g',
                'harga_beli' => 48000,
                'harga_jual' => 52500,
            ],
            [
                'barang_id' => 7,
                'kategori_id' => 4,
                'barang_kode' => 'babyclgn',
                'barang_nama' => 'Johnsons Baby Cologne Heaven 100ml',
                'harga_beli' => 23000,
                'harga_jual' => 26500,
            ],
            [
                'barang_id' => 8,
                'kategori_id' => 4,
                'barang_kode' => 'babylotion',
                'barang_nama' => 'Pure BB Hair Lotion 80ml',
                'harga_beli' => 23000,
                'harga_jual' => 25500,
            ],
            [
                'barang_id' => 9,
                'kategori_id' => 5,
                'barang_kode' => 'antijmr',
                'barang_nama' => '88 Krim Anti Jamur 5g',
                'harga_beli' => 11000,
                'harga_jual' => 15600,
            ],
            [
                'barang_id' => 10,
                'kategori_id' => 5,
                'barang_kode' => 'krim',
                'barang_nama' => 'Counterpain Obat Gosok Cream 30g',
                'harga_beli' => 47000,
                'harga_jual' => 51300,
            ],
        ];
        DB::table('m_barang')->insert($data);
    }
}
