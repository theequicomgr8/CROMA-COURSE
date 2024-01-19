<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Header;
class HeaderController extends Controller
{
    public function index(){
        $data=Header::all();
        //dd($data);
        return view('add-header',compact('data'));
    }
    
    
    public function save(Request $request){
        if(empty($request->input('getid'))){
            $temp=[];
            foreach($request->file('header_pic') as $key => $value){
                if($file=$request->file('header_pic')[$key]){
                    $file = $request->file('header_pic')[$key];
                    $header_pic=time().'-'.$file->getClientOriginalName();
                    $file->move(public_path('/header/'),$header_pic);
                    $temp[]=$header_pic;
                }else{
                   $header_pic=""; 
                }
            }
            $header_pic=implode(",",$temp);
            
            // if($file=$request->file('header_pic')){
            //     $file = $request->file('header_pic');
            //     $header_pic=time().'-'.$file->getClientOriginalName();
            //     $file->move(public_path('/header/'),$header_pic);
            // }else{
            //   $header_pic=""; 
            // }
            
            $data=new Header;
            $data->name=$request->input('name');
            $data->header_pic=$header_pic;
            $data=$data->save();
            if($data){
                return back()->with('msg',"Header Create Successfully");
            }
        }else{
            
            $temp=[];
            if(!empty($request->file('header_pic'))){
                foreach($request->file('header_pic') as $key => $value){
                    if($file=$request->file('header_pic')[$key]){
                        $file = $request->file('header_pic')[$key];
                        $header_pic=time().'-'.$file->getClientOriginalName();
                        $file->move(public_path('/header/'),$header_pic);
                        $temp[]=$header_pic;
                    }else{
                       $header_pic=""; 
                    }
                }
            }
            
            if(!empty($temp)){
                $data=Header::where('id',$request->input('getid'))->first()->header_pic;
                $temp[]=$data;
                $header_pic=implode(",",$temp);
            }else{
                $header_pic=""; 
            }
            
            
            
            // if($file=$request->file('header_pic')){
            //     $file = $request->file('header_pic');
            //     $header_pic=time().'-'.$file->getClientOriginalName();
            //     $file->move(public_path('/header/'),$header_pic);
            // }else{
            //   $header_pic=""; 
            // }
            
            $data=Header::find($request->input('getid'));
            $data->name=$request->input('name');
            if(!empty($header_pic)){
                $data->header_pic=$header_pic;
            }
            $data=$data->save();
            if($data){
                return back()->with('msg',"Header Update Successfully");
            }
        }
        
    }
    
    
    public function headerimage($id){
        $data=Header::where('id',$id)->first();
        return view('header-img',compact('data'));
    }
    
    public function headerimg_delete($id,$img){
        $data=Header::where('id',$id)->first();
        $data=explode(",",$data->header_pic);
        
        $key = array_search($img, $data);
        unset($data[$key]);
        
        $data=implode(",",$data);
        $sql=Header::where('id',$id)->update([
            "header_pic"=>$data    
        ]);
        return back();
        
        
    }
}
