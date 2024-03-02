<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailPenjualanController extends Controller
{
    public function index(){
        $data = DB::select('select * from t_penjualan_detail');
        return view('detail_penjualan', ['data' => $data]);
    }
}
