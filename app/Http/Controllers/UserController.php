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

        $user = UserModel::create(
            [
                'username' => 'manager11',
                'nama' => 'Manager11',
                'password' => Hash::make('12345'),
                'level_id' => 2
            ]);
            $user->username = 'manager12';

            $user->save();

            $user->wasChanged(); //true
            $user->wasChanged('username'); //true
            $user->wasChanged('username','level_id'); //true
            $user->wasChanged('nama'); //false
            dd($user->wasChanged(['nama','username'])); //true

        //dd($user);
        //return view('user',['data' => $user]);

        //akses model UserModel
        //$user = UserModel::all();
        //return view('user', ['data' => $user]);
    }
}
