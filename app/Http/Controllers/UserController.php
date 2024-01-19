<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;
use DB;
use Session;
use Validator;
use App\Models\Category;
use Http;
use File;
class UserController extends Controller
{
    public function index(){
        return view('user-list');
    }

    public function list(Request $request){
        $columns=[
            0=>"id",
            1=>"name",
            2=>"email",
            3=>"mobile",
            4=>"desigination",
            5=>"action",
            6=>"access",
        ];

        $recordsTotal=Login::count();
        $recordsFiltered=$recordsTotal;
        $limit=$request->input('length');
        $start=$request->input('start');
        $order=$columns[$request->input('order.0.column')];
        $dir=$request->input('order.0.dir');
        if(!empty($request->input('search.value'))){
            $search=$request->input('search.value');
            $results =  Login::where('id','LIKE',"%{$search}%")
                        ->orWhere('name', 'LIKE',"%{$search}%")
                        ->offset($start)
                        ->limit($limit)
                        ->orderBy($order,$dir)
                        ->get();
            


        }else{
            //$results=Usermanagment::offset($start);
            $results=DB::table('logins as login');
            $results=$results->select('login.*');
            // $results=$results->join('courses as course','course.id','=','key.course_id');
            // $results=$results->join('priorities as priority','priority.id','=','key.priority');
            // $results=$results->join('categories as category','category.id','=','key.category');
            // $results=$results->join('usermanagments as user','user.id','=','key.executive');
            $results=$results->limit($limit);
            /*if(!empty($filter_keyword)){
                $results=$results->where('key.id',$filter_keyword);
            }*/
            
            
            $results=$results->orderBy($order,$dir);
            $results=$results->get();
        }

        $data=[];
        if(!empty($results)){
            foreach($results as $key => $result){



                $accessicon=basepath("images/access-icon.svg");
                $delete=basepath("images/deleteicon.svg");
                $edit=basepath("images/editicon.svg");
                $lock=basepath("images/lockicon.svg");

                $access="<ul class='justify-content-center'><li><a data-bs-toggle='modal' data-bs-target='#accesspopup' class='accesspup' data-id='$result->id'><img src='$accessicon' alt='access-icon'/></a></li></ul>";

                // $getcategory=Category::whereIn('id',$access)->get();
                // $output='';
                // foreach($getcategory as $value){
                //     $output.=;
                // }
                

                $action="<ul><li><a data-bs-toggle='modal' data-bs-target='#useredittab' class='useredit' data-id='$result->id' data-name='$result->name' data-email='$result->email' data-mobile='$result->mobile' data-desigination='$result->desigination' data-access='$result->access'><img src='$edit' alt='editicon'/></a></li><li><a data-bs-toggle='modal' data-bs-target='#changepassword' class='userpassword' data-id='$result->id'><img src='$lock' alt='lockicon'/></a></li><li><a href='' class='delete' data-id='$result->id' data-table='logins'><img src='$delete' alt='deleteicon'/></a></li></ul>";

                $record['id']=$result->id;
                $record['name']=$result->name;
                $record['email']=$result->email;
                $record['mobile']=$result->mobile;
                $record['desigination']=$result->desigination;
                $record['action']=$action;
                $record['access']=$access;
                $data[]=$record;
            }
        }

        $json_data=[
            "draw"=>intval($request->input('draw')),
            "recordsTotal"=>intval($recordsTotal),
            "recordsFiltered"=>intval($recordsFiltered),
            "data"=>$data
        ];
        return json_encode($json_data);
        //return view('userdata');
    }



    public function save(Request $request){
        if(empty($request->input('id'))){
            //insert
            $validator=Validator::make($request->all(),[
                'name' =>'required',
                'email' =>'required',
                'password' =>'required',
                'mobile' =>'required',
                'desigination' =>'required'
            ]);


            if(!$validator->passes()){
                return response()->json(["status"=>0,"error"=>$validator->errors()->toArray()]);
            }

            $data=new Login;
            $data->name=$request->input('name');
            $data->email=$request->input('email');
            $data->password=$request->input('password');
            $data->mobile=$request->input('mobile');
            $data->desigination=$request->input('desigination');
            $data->access=implode(",", $request->input('access'));
            $data->role="user";
            $data=$data->save();
            if($data){
                return response()->json(["status"=>1,"msg"=>"User Save Successfully"]);
            }else{
                return response()->json(["status"=>1,"msg"=>"Some Error"]);
            }
        }else{
            //update
            $validator=Validator::make($request->all(),[
                'name' =>'required',
                'email' =>'required',
                // 'password' =>'required',
                'mobile' =>'required',
                'desigination' =>'required'
            ]);


            if(!$validator->passes()){
                return response()->json(["status"=>0,"error"=>$validator->errors()->toArray()]);
            }

            $data=Login::find($request->input('id'));
            $data->name=$request->input('name');
            $data->email=$request->input('email');
            // $data->password=$request->input('password');
            $data->mobile=$request->input('mobile');
            $data->desigination=$request->input('desigination');
            $data->access=implode(",", $request->input('access'));
            $data->role="user";
            $data=$data->save();
            if($data){
                return response()->json(["status"=>2,"msg_edit"=>"User Update Successfully"]);
            }else{
                return response()->json(["status"=>2,"msg_edit"=>"Some Error"]);
            }
        }
    }


    public function getaccess(Request $request){
        $id=$request->input('id');
        $data=Login::where('id',$id)->first();
        $access=$data->access;
        $access=explode(",", $access);
        $getcategory=Category::whereIn('id',$access)->get();
        $output='';
        foreach($getcategory as $value){
            $output.='<div class="student-document">';
            $output.="<h3>".$value->category."</h3>";
            $output.='</div>';
        }
        return $output;
    }



    public function getcatname(Request $request){
        $id=$request->input('useraccess');
        $id=explode(",", $id);
        $data=Category::whereIn('id',$id)->get();
        $output='';
        foreach($data as $value){
            $output.="<option selected value='".$value->id."'>".$value->category."</option>";
        }
        return $output;
    }




    public function changepassword(Request $request){
        
        $validator=Validator::make($request->all(),[
            'password' =>'required|confirmed',
            'password_confirmation' =>'required'
        ]);
        if(!$validator->passes()){
            return response()->json(["status"=>0,"error"=>$validator->errors()->toArray()]);
        }
        $id=$request->input('id');
        $password=$request->input('password');
        // $cpassword=$request->input('cpassword');
        $data=Login::where('id',$id)->update(["password"=>$password]);
        if($data){
            return response()->json(["status"=>1,"cmsg"=>"Password Change Sussessfully"]);
        }else{
            return response()->json(["status"=>0,"cmsg"=>"Some Error"]);
        }
        
    }
    
    
    
    
 public function lsqdata(Request $request){
       
        /*$admission = New Admission;		
		$admission->name = $request->session()->get('name').' '.$request->session()->get('lname');			 
		$admission->email = $request->session()->get('email');
		$admission->code = $request->session()->get('code');
		$admission->mobile =$request->session()->get('mobile');
		$admission->whatsapp_no =$request->session()->get('whatsapp_no');
		$admission->add_type = 1;						 			 
		$admission->course =$request->session()->get('course');				 
		$admission->amount =$request->session()->get('amount');			 
		$admission->mode =$request->session()->get('mode');			 
		$admission->counsellor =$request->session()->get('counsellor');				 
		$admission->counsellormobile =$request->session()->get('counsellormobile');				 
		$admission->company =$request->session()->get('company');					 
		$admission->participants =$request->session()->get('participants');	*/
       //dd($request->input('name')); &secretKey
       
            $validator = Validator::make($request->all(),[							
				'name' 	=> 'required|regex:/^[\pL\s\-]+$/u|min:3|max:32',					
				'email' 	=> 'required|regex:/^[^\s()<>@,;:\/]+@\w[\w\.-]+\.[a-z]{2,}$/i',					
				'mobile' 	=> 'required|numeric',
				'course'=>'required',				
				'code' 	=> 'required|numeric',
				'amount'=>'required',
				'mode'=>'required',
				'counsellor'=>'required',
				
				'category'=>'required',
		 		'totalAmount'=>'required',
		 		//'secretKey'=>'required'
			]); 
			
			if($validator->fails()){
				$errorsBag = $validator->getMessageBag()->toArray();
				return response()->json(['status'=>1,'errors'=>$errorsBag],400);
			}
			//dd($request->input('name'));
	    //$finduser=DB::connection('mysql3')->table('wp_users')->where('display_name',$request->input('counsellor'))->first();
	    $name=$request->input('counsellor');
	    $finduser=DB::connection('mysql3')->table('wp_users')->where('display_name','LIKE','%'.$name.'%')->first();
	    $counsellor=$finduser->ID ?? $request->input('counsellor');
	    
       $protect=$request->input('_token');
       if($protect=='MFwwDQYJKoZIhvcNAQEBBQADSwA'){
           $data=DB::connection('mysql3')->table('wp_register_students')->insert([
                "name"=>$request->input('name'),
                "email"=>$request->input('email'),
                "code"=>$request->input('code'),
                "mobile"=>$request->input('mobile'),
                "whatsapp_no"=>$request->input('mobile'),
                //"add_type"=>$request->input('add_type'),
                "course"=>$request->input('course'),
                "amount"=>$request->input('amount'),
                "mode"=>$request->input('mode'),
                "counsellor"=>$counsellor,//$request->input('counsellor'),
                "totalAmount"=>$request->input('totalAmount'),
                "category"=>$request->input('category')
                //"counsellormobile"=>$request->input('counsellormobile'),
                //"company"=>$request->input('company'),
                //"participants"=>$request->input('participants')
            ]);
       }else{
           return response()->json(["status"=>false,"msg"=>'Invalid secretKey']);
       }
        
        
        if($data){
            return response()->json(["status"=>true,"msg"=>'Data Saved Successfully']);
        }else{
            return response()->json(["status"=>false,"msg"=>'Sone Error']);
        }
    }
    
    
    
    
    
    public function savedata(Request $request){
        dd($request->input('name'));
        
    }
    
    
    
    
    public function demo(){
        $url = "course.cromacampus.com/api/savedata";
        $data = [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
        ];
        $response = Http::post($url, $data);
        dd($response->json());
    }
}
