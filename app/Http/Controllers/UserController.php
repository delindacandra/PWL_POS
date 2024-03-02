<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        //$data = DB::select('select * from m_user');
        //return view('user', ['data' => $data]);

        //tambah data user dengan Eloquent Model
        $data=[
            'nama' => 'Pelanggan Pertama',
        ];
        UserModel::where('username', 'customer-1')->update($data);

        //akses model UserModel
        $user = UserModel::all();
        return view('user', ['data' => $user]);
    }
}
