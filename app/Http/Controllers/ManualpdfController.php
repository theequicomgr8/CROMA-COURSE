<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manualpdf;
use App\Models\Course;
use App\Models\Category;
class ManualpdfController extends Controller
{
    public function index(Request $request){
        if($file=$request->file('pdf_name')){
            $file = $request->file('pdf_name');
            $pdf_name=time().'-'.$file->getClientOriginalName();
            $file->move(public_path('/manual_pdf/'),$pdf_name);
        }else{
          $pdf_name=""; 
        }
        
        $category_id=$request->input('category_id');
        $course_id=$request->input('course_id');
        
        $data=new Manualpdf;
        $data->category_id=$category_id;
        $data->course_id=$course_id;
        if(!empty($pdf_name)){
            $data->pdf_name=$pdf_name;
        }
        $data=$data->save();
        if($data){
            return back()->with('msg','PDF Upload Successfully');
        }
    }
}
