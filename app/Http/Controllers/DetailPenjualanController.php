<?php

namespace App\Http\Controllers;

use App\Models\PenjualanDetailModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailPenjualanController extends Controller
{
    public function index()
    {
        $data = DB::select('select * from t_penjualan_detail');
        return view('detail_penjualan', ['data' => $data]);
    }
    public function store(Request $request, $penjualan_id)
    {
        $request->validate([
            'barang_id' => 'required',
            'harga' => 'required',
            'jumlah' => 'required'
        ]);

        // Simpan detail penjualan dengan menggunakan $penjualan_id
        PenjualanDetailModel::create([
            'penjualan_id' => $penjualan_id,
            'barang_id' => $request->barang_id,
            'jumlah' => $request->jumlah,
            'harga' => $request->harga
        ]);

        return redirect('/penjualan')->with('success', 'Data berhasil ditambahkan');
    }
}
