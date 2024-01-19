<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;
use Session;
use DB;
class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function auth(Request $request){
        $validate=$request->validate([
            "name" => 'required',
            "password" => 'required',
        ]);
        $data=Login::where('name',$request->input('name'))->where('password',$request->input('password'))->first();

        if($data){
            Session::put('Auth_id',$data->id);
            Session::put('Auth_name',$data->name);
            Session::put('role',$data->role);
            Session::put('access',$data->access);
            return redirect('curriculm-list');
        }else{
            dd('faield');
            return back()->with('msg','Login Faield');
        }

    }

    public function logout(){
        session_unset();
        Session::flush();
        return redirect('/');
    }
}
