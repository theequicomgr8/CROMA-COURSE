<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Footer;
class FooterController extends Controller
{
    public function index(){
        $data=Footer::all();
        //dd($data);
        return view('add-footer',compact('data'));
    }
    
    
    public function save(Request $request){
        if(empty($request->input('getid'))){
            /*if($file=$request->file('footer_pic')){
                $file = $request->file('footer_pic');
                $footer_pic=time().'-'.$file->getClientOriginalName();
                $file->move(public_path('/footer/'),$footer_pic);
            }else{
               $footer_pic=""; 
            }*/
            
            $temp=[];
            foreach($request->file('footer_pic') as $key => $value){
                if($file=$request->file('footer_pic')[$key]){
                    $file = $request->file('footer_pic')[$key];
                    $footer_pic=time().'-'.$file->getClientOriginalName();
                    $file->move(public_path('/footer/'),$footer_pic);
                    $temp[]=$footer_pic;
                }else{
                   $footer_pic=""; 
                }
            }
            $footer_pic=implode(",",$temp);
            
            
            $data=new Footer;
            $data->name=$request->input('name');
            $data->footer_pic=$footer_pic;
            $data=$data->save();
            if($data){
                return back()->with('msg',"Footer Create Successfully");
            }
        }else{
            /*if($file=$request->file('footer_pic')){
                $file = $request->file('footer_pic');
                $footer_pic=time().'-'.$file->getClientOriginalName();
                $file->move(public_path('/footer/'),$footer_pic);
            }else{
               $footer_pic=""; 
            }*/
            $temp=[];
            if(!empty($request->file('footer_pic'))){
                foreach($request->file('footer_pic') as $key => $value){
                    if($file=$request->file('footer_pic')[$key]){
                        $file = $request->file('footer_pic')[$key];
                        $footer_pic=time().'-'.$file->getClientOriginalName();
                        $file->move(public_path('/header/'),$footer_pic);
                        $temp[]=$footer_pic;
                    }else{
                       $footer_pic=""; 
                    }
                }
            }
            
            if(!empty($temp)){
                $data=Footer::where('id',$request->input('getid'))->first()->footer_pic;
                $temp[]=$data;
                $footer_pic=implode(",",$temp);
            }else{
                $footer_pic=""; 
            }
            
            
            $data=Footer::find($request->input('getid'));
            $data->name=$request->input('name');
            if(!empty($footer_pic)){
                $data->footer_pic=$footer_pic;
            }
            $data=$data->save();
            if($data){
                return back()->with('msg',"Footer Update Successfully");
            }
        }
        
    }
    
    
    
    public function footerimage($id){
        $data=Footer::where('id',$id)->first();
        return view('footer-img',compact('data'));
    }
    
    public function footerimg_delete($id,$img){
        $data=Footer::where('id',$id)->first();
        $data=explode(",",$data->footer_pic);
        
        $key = array_search($img, $data);
        unset($data[$key]);
        
        $data=implode(",",$data);
        $sql=Footer::where('id',$id)->update([
            "footer_pic"=>$data    
        ]);
        return back();
        
        
    }
    
    
}
