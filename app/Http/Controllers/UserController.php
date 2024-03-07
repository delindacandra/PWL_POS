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

        //retrievinng single models
            //$user = UserModel::firstWhere('level_id', 1);
            //return view('user', ['data' => $user]);

        $user = UserModel::where('level_id', 2)->count();
        //dd($user);
        return view('user',['data' => $user]);

        //akses model UserModel
        //$user = UserModel::all();
        //return view('user', ['data' => $user]);
    }
}
