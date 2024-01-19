<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Desigination;
use DB;
class DesiginationController extends Controller
{
    public function index(){
        $data=Desigination::all();
        //dd($data);
        return view('designation',compact('data'));
    }

    public function save(Request $request){
        if(empty($request->input('id'))){
            $data=new Desigination;
            $data->name=$request->input('name');
            $data=$data->save();
            if($data){
                return back()->with('msg','Data Saved Successfully');
            }
        }else{
            $data=Desigination::find($request->input('id'));
            $data->name=$request->input('name');
            $data=$data->save();
            if($data){
                return back()->with('msg','Data Saved Successfully');
            }
        }
        
    }


    public function changestatus(Request $request){
        $table=$request->input('table');
        $status=$request->input('status');
        $id=$request->input('id');
        if($status=='0'){
            $data=DB::table($table)->where('id',$id)->update(["status"=>1]);
        }else{
            $data=DB::table($table)->where('id',$id)->update(["status"=>0]);
        }

        if($data){
            return response()->json(["status"=>true,"msg"=>"status change Successfully"]);
        }else{
            return response()->json(["status"=>false,"msg"=>"Some Error"]);
        }
    }


    public function delete(Request $request){
        $table=$request->input('table');
        $id=$request->input('id');
        $data=DB::table($table)->where('id',$id)->delete();
        
    }
}
