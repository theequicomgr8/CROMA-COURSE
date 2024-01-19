<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Course;
use DB;
use App\Imports\CurriculumImport;
use Excel;
use Session;
use App\Models\Header;
use App\Models\Footer;
use PDF;
use App\Models\Curriculum;
use App\Models\Template;
use App\Models\Manualpdf;
use Http;
use Map;
class CurriculmController extends Controller
{
    public function index(){
        // $data=DB::table('croma_courses');
        // $data->select('croma_category.category as category_name','croma_category.id as category_id');
        // $data=$data->join('croma_category','croma_category.id','croma_courses.category');
        // $data=$data->groupBy('croma_courses.category');
        // $data=$data->get();
        
        //$data = Http::get("https://www.cromacampus.com/getcategory");
        $data=json_decode(file_get_contents('https://www.cromacampus.com/getcategory'), true);
        $data=collect($data);
        
        
        //dd($data);
        //dd($data['0']['category_id']);
        
        

        return view('curriculum-list',["data"=>$data]);
    }
    
    public function getdata(Request $request){
        $columns=[
            0=>"category",
            
        ];

        $recordsTotal=Course::groupBy('category')->count();
        $recordsFiltered=$recordsTotal;
        $limit=$request->input('length');
        $start=$request->input('start');
        $order=$columns[$request->input('order.0.column')];
        $dir=$request->input('order.0.dir');
        if(!empty($request->input('search.value'))){
            $search=$request->input('search.value');
            $results =  Category::where('id','LIKE',"%{$search}%")
                        ->orWhere('category', 'LIKE',"%{$search}%")
                        ->offset($start)
                        ->limit($limit)
                        ->orderBy($order,$dir)
                        ->get();
            


        }else{
            
            //$results=DB::connection('mysql2')->table('croma_category as cat');
            //$results=$results->select('cat.category as cat_name','cat.id as id');
            //$results=$results->join('croma_courses as course','course.category','=','cat.id');
            //$results=Course::groupBy('category');
            //$results=$results->limit($limit);
            //$results=$results->orderBy($order,$dir);
            //$results=$results->get();
            $results=Category::orderBy($order,$dir)->get();
        }

        $data=[];
        
        if(!empty($results)){
            foreach($results as $key => $result){

                $pdf=basepath('images/pdficon.svg');
                $uploadicon=basepath('images/uploadicon.svg');
                $downloadicon=basepath('images/downloadicon.svg');
                $excelicon=basepath('images/excelicon.svg');
                $viewicon=basepath('images/viewicon.svg');
                $editicon=basepath('images/editicon.svg');
                $deleteicon=basepath('images/deleteicon.svg');
                $output="";
                $getcourse=Course::where('category',$result->id)->get();
                //dd($getcourse);
                $total=count($getcourse);
                
                foreach($getcourse as $value){
                    $output.="<div id='collapseOne$key' class='accordion-collapse collapse' aria-labelledby='headingOne$key' data-bs-parent='#accordionExample'> <div class='accordion-body'> <div class='list-curriculum'> <div class='pdfname'> <h2> <img src='$pdf' alt=''> $value->course_name'sdsd' </h2> </div> <div class='download-pdfbox'> <ul> <li> <a data-bs-toggle='modal' data-bs-target='#uploadpdfmodel'> <img src='$uploadicon' alt='uploadicon'> </a> <a href=''> <img src='$downloadicon' alt='downloadicon'> </a> </li> <li> <a href=''> <img src='$excelicon' alt='excelicon'> </a> <a href=''> <img src='$viewicon' alt='viewicon'> </a> <a href='edit-new-course-curriculum.html'> <img src='$editicon' alt='editicon'> </a> </li> <li> <a href=''> <img src='$downloadicon' alt='downloadicon'> </a> <a href=''> <img src='$deleteicon' alt='deleteicon'> </a> </li> </ul> </div> </div>    </div> </div>";
                }
                
               // print_r($output);
                
                $res="<div class='accordion-item'> <h2 class='accordion-header' id='headingOne$key'> <div class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#collapseOne$key' aria-expanded='true' aria-controls='collapseOne$key'> <span class=''>$result->category</span>
                <ul class='list-cri'> <li>Total: $total</li> <li>Available: 4</li> </ul> </div> </h2> $output  </div>";
                
                $record['category']=$res.$result->id;//$result->category;
               // print_r($record);
                $data[]=$record;
            }
        }

        $json_data=[
            "draw"=>intval($request->input('draw')),
            "recordsTotal"=>intval($recordsTotal),
            "recordsFiltered"=>intval($recordsFiltered),
            "data"=>$data
        ];
        //dd($json_data);
        return json_encode($json_data);
        //return view('listpdfdata');
    }
    
    
   public function getcourse(Request $request){
       $category_id= $request->input('category_id');
       //$getcourse=Course::where('category',$category_id)->get();
       
       $getcourse=json_decode(file_get_contents("https://www.cromacampus.com/findCourse/".$category_id), true);
       $getcourse=collect($getcourse);
                                  
       $output="";
       $output.="<option>Select Course</iption>";
       foreach($getcourse as $value){
           $output.="<option value='".$value['id']."'>".$value['course_name']."</option>";
       }
       return $output;
   }
    
    public function course_curriculum(Request $request){
        $category_id=$request->input('category_id');
        $course_id=$request->input('course_id');
        Session::put('category_id',$category_id);
        Session::put('course_id',$course_id);
        $header_id=$request->input('header_id');
        $footer_id=$request->input('footer_id');
        
        
        
        $templat_id=DB::table('templates')->insertGetId([
            "header_id"=>$header_id,
            "footer_id"=>$footer_id,
            "category_id"=>$category_id,
            "course_id"=>$course_id,
            //"file_name"=>$file_name,
        ]);
        Session::put('template_id',$templat_id);
        $file=$request->file('excelfile');
        $data=Excel::Import(new CurriculumImport,$file);
        
        if($file=$request->file('excelfile')){
            $file = $request->file('excelfile');
            $file_name=time().'-'.$file->getClientOriginalName();
            $file->move(public_path('/excel/'),$file_name);
        }else{
          $file_name=""; 
        }
        DB::table('templates')->where('id',$templat_id)->update(["file_name"=>$file_name]);
        
        
        
        //for pdf load start
        $data=Curriculum::where('category_id',Session::get('category_id'))->where('course_id',Session::get('course_id'))->get()->toArray();
        $result = [
            'title' => 'Welcome to cromacampus.com',
            'data' => $data
        ];
        $pdf = PDF::loadView('curriculumpdf', $result);
        $pdf->save(public_path('loadpdf/my.pdf'));
        
        //this part to download pdf from cromacampus start
        $courseName=json_decode(file_get_contents("https://www.cromacampus.com/getCourseName/".$course_id), true);
        $courseName=collect($courseName);
        $courseName=$courseName['0']['slug'];
        Session::put('courseName',$courseName);
        $pdf->save(public_path('loadpdf/'.$courseName.'.pdf'));
        //this part to download pdf from cromacampus End
        //for pdf load end 
        
        
        //save data 
        
        
        
        return redirect()->route('curriculm.create');
        //return redirect()->route('curriculm.list');
            
    }
    
    
    
    public function create(){
        /*$categorydata=DB::table('croma_courses');
        $categorydata->select('croma_category.category as category_name','croma_category.id as category_id');
        $categorydata=$categorydata->join('croma_category','croma_category.id','croma_courses.category');
        $categorydata=$categorydata->groupBy('croma_courses.category');
        $categorydata=$categorydata->get();*/
        
        $categorydata=json_decode(file_get_contents('https://www.cromacampus.com/getcategory'), true);
        $categorydata=collect($categorydata);
        
        $header=Header::where('status',1)->get();
        $footer=Footer::where('status',1)->get();
        return view('create-curriculm',compact('categorydata','header','footer'));
    }
    
    public function edit($id){
        /*$categorydata=DB::table('croma_courses');
        $categorydata->select('croma_category.category as category_name','croma_category.id as category_id');
        $categorydata=$categorydata->join('croma_category','croma_category.id','croma_courses.category');
        $categorydata=$categorydata->groupBy('croma_courses.category');
        $categorydata=$categorydata->get();*/
        $categorydata=json_decode(file_get_contents('https://www.cromacampus.com/getcategory'), true);
        $categorydata=collect($categorydata);
        
        $header=Header::where('status',1)->get();
        $footer=Footer::where('status',1)->get();
        
        $templatedata=DB::table('templates')->where('course_id',$id)->first();
        
        //$getcourse=DB::table('croma_courses')->where('category',$templatedata->category_id)->get();
        $getcourse=json_decode(file_get_contents("https://www.cromacampus.com/findCourse/".$templatedata->category_id), true);
        $getcourse=collect($getcourse);
        
        //for pdf load start
        $data=Curriculum::where('course_id',$id)->get()->toArray();
        $result = [
            'title' => 'Welcome to cromacampus.com',
            'data' => $data
        ];
        $pdf = PDF::loadView('curriculumpdf', $result);
        $pdf->save(public_path("loadpdf/$id.pdf"));
        //for pdf load end 
        
        
        return view('edit-curriculm',compact('categorydata','header','footer','templatedata','getcourse'));
    }
    
    
    public function update(Request $request){
        //data update code
        $coid=$request->input('coid');//hidden id
        
        $category_id=$request->input('category_id');
        $course_id=$request->input('course_id');
        Session::put('category_id',$category_id);
        Session::put('course_id',$course_id);
        $header_id=$request->input('header_id');
        $footer_id=$request->input('footer_id');
        
        //$deletetemplate=DB::table('templates')::where('course_id',$coid)->delete(); 
        
        
        
        
        
        
        /*$templat_id=DB::table('templates')->insertGetId([
            "header_id"=>$header_id,
            "footer_id"=>$footer_id,
            "category_id"=>$category_id,
            "course_id"=>$course_id,
            //"file_name"=>$file_name,
        ]);*/
        $templat=DB::table('templates')->where('course_id',$coid)->update([
            "header_id"=>$header_id,
            "footer_id"=>$footer_id,
            //"category_id"=>$category_id,
            //"course_id"=>$course_id,
            
            //"file_name"=>$file_name,
        ]);
        $gettemplateid=Template::where('course_id',$coid)->first();
        $templat_id=$gettemplateid->id;
        
        Session::put('template_id',$templat_id);
        
        
        
        $file=$request->file('excelfile');
        if(!empty($file)){
            $deletecurriculums=DB::table('curriculums')->where('course_id',$coid)->delete();
            $data=Excel::Import(new CurriculumImport,$file);
        
            if($file=$request->file('excelfile')){
                $file = $request->file('excelfile');
                $file_name=time().'-'.$file->getClientOriginalName();
                $file->move(public_path('/excel/'),$file_name);
            }else{
              $file_name=""; 
            }
            DB::table('templates')->where('id',$templat_id)->update(["file_name"=>$file_name]);
        }
        return back();
        
    }
    
    
    public function listpdf($categoryid,$courseid){
        
        
        $data=Curriculum::where('category_id',$categoryid)->where('course_id',$courseid)->get()->toArray();
        //dd($data);
        $result = [
            'title' => 'Welcome to cromacampus.com',
            'data' => $data
        ];
        $pdf = PDF::loadView('curriculumpdf', $result);
        //$pdf->save(public_path('learnhindituts_pdf.pdf'));
         return $pdf->stream ('my.pdf');
        return $pdf->download('my.pdf');
    }
    
    public function viewpdf($categoryid,$courseid){
        
        
        $data=Curriculum::where('category_id',$categoryid)->where('course_id',$courseid)->get()->toArray();
        
        $result = [
            'title' => 'Welcome to cromacampus.com',
            'data' => $data
        ];
        $pdf = PDF::loadView('curriculumpdf', $result);
        //$pdf->save(public_path('learnhindituts_pdf.pdf'));
         return $pdf->stream ('my.pdf');
        //return $pdf->download('my.pdf');
    }
    
    
    public function curriculum_delete($categoryid,$courseid){
        $data=Curriculum::where('category_id',$categoryid)->where('course_id',$courseid)->delete();
        $deletetemplate=Template::where('category_id',$categoryid)->where('course_id',$courseid)->delete(); 
        $deletemanualpdf=Manualpdf::where('category_id',$categoryid)->where('course_id',$courseid)->delete(); 
        return back();
    }
    
    
    public function getapi(){
        $response = Http::get("https://www.leadpitch.in/apidata");
        return $response;
    }
    
   //these api add in croma campus website 
    public function getcategory(){
		$data=DB::table('croma_courses');
        $data->select('croma_category.category as category_name','croma_category.id as category_id');
        $data=$data->join('croma_category','croma_category.id','croma_courses.category');
        $data=$data->groupBy('croma_courses.category');
        $data=$data->get();
		return $data;
	}

	public function findCourse($id){
		$getcourse=DB::table('croma_courses')->where('category',$id)->groupBy('course_name')->orderBy('id','desc')->get();
		return $getcourse;
	}
    
	public function findcategory($categoryid){
		$getcategory=DB::table('croma_category')->where('id',$categoryid)->get();
		return $getcategory;
	}
	
	public function feesupdateapi(Request $request){
		$id=$request->input('cid');
		$fees=$request->input('fees_amount');
		$total=$fees*10;
		$total=$total/100;
		$discount=10;
		$$discount_status=1;
		if($fees==0){
			$total=0;
			$discount_status=0;
			$discount=0;
		}
		$data=DB::table('croma_courses')->where('id',$id)->update([
			"fees_amount"=>$total,  //$fees, 
			"total_amount"=>$fees, //$total, 
			"discount_status"=>$discount_status,
			"discount"=>$discount
		]);
		
	}
	
	public function getCourseName($id){
		$getcourse=DB::table('croma_courses')->where('id',$id)->groupBy('course_name')->orderBy('id','desc')->get();
		return $getcourse;
	}
	
	public function countfees($id){
		$countfees=DB::table('croma_courses')->where('category',$id)->where('total_amount','>','0')->get();
		return $countfees;
	}
	
	
	
	/*Route::get('getcategory','Site\HomeController@getcategory');
    Route::get('findCourse/{id?}','Site\HomeController@findCourse');
    Route::get('findcategory/{id?}','Site\HomeController@findcategory');
    Route::post('feesupdateapi','Site\HomeController@feesupdateapi');
    Route::get('getCourseName/{id?}','Site\HomeController@getCourseName');
    Route::get('countfees/{id?}','Site\HomeController@countfees');*/
    
    /*  
    'thankyou',
        'thankyou-cca',
        'trigomatix-thankyou-cca',
        'xapotech-thankyou',
        'success',
        'failed',
        'cronjob',
        'responseairpay',
		'thankyou-cc',
        'lsqdata',
        'getcategory',
        'feesupdateapi',
        'getCourseName'
    */
    
    
    /*
    course detail page 
    onsubmit="return homeController.savedownloadCurriculum(this)"  form tag me ye add kare
    data-cname="<?= $coursesdetails->course_name.'.pdf' ?>"
    
    script.js
    savedownloadCurriculum function me 
    var pdfslug   = $this.data('pdfslug'); iske niche ye add kare 
    var cname   = $this.data('cname');
    
    if(pdfslug){
    	//var url="https://cromacampus.com/public/download/"+pdfslug;  //old
    	var url="https://course.cromacampus.com/public/loadpdf/"+cname;  //ye add karna hai
    	window.open(url,'_blank');
    }
    
    */
}
