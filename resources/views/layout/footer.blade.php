<!-- footer here  -->
<section class="footer-section">
   <div class="container">
      <div class="row">
         <div class="text-center footerlinks">
            <p class="mb-0">Copyright © 2008-2023 Croma Campus(P)Ltd.All rights Reserved.</p>
         </div>
      </div>
   </div>
</section>
<!-- popup model change password  -->

 <!-- Modal -->
 <div class="modal mymodel fade" id="changepassword" tabindex="-1" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="form-content text-center d-grid">
         <h5 class="modal-title">Reset Password</h5>
         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
   
         </div>
         <span id="cmsg" class="text-success"></span>
         <div class="form-changepassword">

            <form method="post" id="changepassword_form" class="d-grid gap-3" autocomplete="off">
                  @csrf
                  <input type="hidden" name="id" id="passwordid" value="{{Session::get('Auth_id')}}">
                  <div class="form-re">
                     <input type="password" name="password" class="my-from-control"  placeholder="New Password">
                     <i class="fa-light check fa-circle-check"></i>
                  </div>
                  <div class="form-re">
                     <input type="password" name="password_confirmation" class="my-from-control "  placeholder="Confirm Password">
                     <i class="fa-light cross fa-circle-xmark"></i>                 
                  </div>
                  <div class="form-re text-center">
                     <input type="submit" class="btn btn-red w175 m-auto" style="border-radius: var(--padding-box-30);
                     " value="Update"></div>
            </form>
         </div>
     </div>
 </div>
 </div>

                         <!-- popup model change password end -->
<!-- popup model Add Candidate section start   -->

<div class="modal mymodel fade" id="useraddtab" tabindex="-1" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
         <div class="form-content text-center d-grid">
           <h5 class="modal-title">Add User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <span class="text-success" id="msg"></span>
            <div class="form-changepassword">
               <form method="post" id="user_form">
                  @csrf
                  <div class="form-login mb-0">
                     <div class="row">
                        <div class="col-lg-12">
                           <label class="form-label">User Name</label>
                           <input type="text" name="name" class="my-from-control" id="" placeholder="Enter Your Name">
                           <span class="error name_err"></span>
                        </div>                      
        
                     </div>
                  </div>
                  <div class="form-login mb-0">
                     <div class="row">
                        <div class="col-lg-6">
                           <label class="form-label">Email ID</label>
                           <input type="text" name="email" class="my-from-control" id="" placeholder="Enter Email Id">
                           <span class="error email_err"></span>
                        </div>
                        <div class="col-lg-6">
                           <label class="form-label">Mobile No.</label>
                           <input type="text" name="mobile" class="my-from-control" id="" placeholder="Enter Mobile No.">
                           <span class="error mobile_err"></span>
                        </div>
                      
                     </div>
                  </div>
                  <div class="form-login mb-0">
                     <div class="row">
                        <div class="col-lg-6">
                           <label class="form-label">Designation</label>
                           <select class="my-from-control selectcol" name="desigination" aria-label="Select Priority">
                              <option value="">Select Priority</option>
                              @php
                              $data=App\Models\Desigination::where('status',1)->get();
                              @endphp
                              @if(!empty($data))
                              @foreach($data as $value)
                              <option {{$value->name}} >{{$value->name}}</option>
                              @endforeach
                              @endif
                           </select>
                           <span class="error desigination_err"></span>
                        </div>
                        <div class="col-lg-6">
                           <label class="form-label">Password</label>
                           <input type="text" name="password" class="my-from-control" id="" placeholder="Enter Password">
                           <span class="error password_err"></span>
                        </div>
                      
                     </div>
                  </div>
  
                  <div class="form-login mb-0">
                     <div class="row">
                        <div class="col-lg-12">
                           <label class="form-label">Access</label>
                           <select data-placeholder="Access Here..." multiple class="chosen-select" name="access[]">
                              <option value=""></option>
                              @php
                              $data=App\Models\Course::groupBy('category')->get();
                              foreach($data as $coursedata){
                                 $categoryid[]=$coursedata->category;
                              }
                              $category=implode(",",$categoryid);
                              $category=explode(",",$category);
                              $getcaategory=App\Models\Category::whereIn('id',$category)->get();
                              @endphp
                              @foreach($getcaategory as $cat)
                              <option value="{{$cat->id}}">{{$cat->category}}</option>
                              @endforeach
                              
                           </select>

                        </div>
                     </div>
                  </div>
    

                  <div class="form-re text-center">   
                     <input type="submit" value="Submit" class="btn btn-red w175 m-auto" style="border-radius: var(--padding-box-30);
                     ">
                 </div>               
               </form>
            </div>

     </div>
 </div>
 </div>

<!-- popup model Candidate section end   -->

<!-- user edit form start -->
<!-- popup model user edit start  -->

<div class="modal mymodel fade" id="useredittab" tabindex="-1" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
         <div class="form-content text-center d-grid">
           <h5 class="modal-title">User Edit</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <span class="text-success" id="msg_edit"></span>
            <div class="form-changepassword">
               <form method="post" id="user_editform">
                  @csrf
                  <input type="hidden" name="id" id="userid">
                  <div class="form-login mb-0">
                     <div class="row">
                        <div class="col-lg-12">
                           <label class="form-label">User Name</label>
                           <input type="text" name="name" class="my-from-control" id="username" placeholder="Enter Your Name">
                           <span class="error name_err"></span>
                        </div>                      
        
                     </div>
                  </div>
                  <div class="form-login mb-0">
                     <div class="row">
                        <div class="col-lg-6">
                           <label class="form-label">Email ID</label>
                           <input type="text" name="email" class="my-from-control" id="useremail" placeholder="Enter Email Id">
                           <span class="error email_err"></span>
                        </div>
                        <div class="col-lg-6">
                           <label class="form-label">Mobile No.</label>
                           <input type="text" name="mobile"  class="my-from-control" id="usermobile" placeholder="Enter Mobile No.">
                           <span class="error mobile_err"></span>
                        </div>
                      
                     </div>
                  </div>
                  <div class="form-login mb-0">
                     <div class="row">
                        <div class="col-lg-12">
                           <label class="form-label">Designation</label>
                           <select name="desigination" class="my-from-control selectcol" id="userdesigination" aria-label="Select Priority">
                              <option value="">Select Priority</option>
                              @php
                              $data=App\Models\Desigination::where('status',1)->get();
                              @endphp
                              @if(!empty($data))
                              @foreach($data as $value)
                              <option {{$value->name}} >{{$value->name}}</option>
                              @endforeach
                              @endif
                           </select>
                           <span class="error desigination_err"></span>
                        </div>
                      
                     </div>
                  </div>
  
                  <div class="form-login mb-0" style="display: none;">
                     <div class="row">
                        <div class="col-lg-12">
                           <label class="form-label">Access</label>
                           <select data-placeholder="Access Here..." multiple class="chosen-select useraccess" name="access[]" id="useraccess">
                              <!-- <option value=""></option> -->
                              @php
                              $data=App\Models\Course::groupBy('category')->get();
                              foreach($data as $coursedata){
                                 $categoryid[]=$coursedata->category;
                              }
                              $category=implode(",",$categoryid);
                              $category=explode(",",$category);
                              $getcaategory=App\Models\Category::whereIn('id',$category)->get();
                              @endphp
                              @foreach($getcaategory as $cat)
                              <option value="{{$cat->id}}">{{$cat->category}}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                  </div>


                  <div class="form-login mb-0">
                     <div class="row">
                        <div class="col-lg-12">
                           <label class="form-label">Access</label>
                           <select  multiple class="form-control useraccess1" name="access[]" id="useraccess1">
                              <!-- <option value=""></option> -->
                              @php
                              $data=App\Models\Course::groupBy('category')->get();
                              foreach($data as $coursedata){
                                 $categoryid[]=$coursedata->category;
                              }
                              $category=implode(",",$categoryid);
                              $category=explode(",",$category);
                              $getcaategory=App\Models\Category::whereIn('id',$category)->get();
                              @endphp
                              @foreach($getcaategory as $cat)
                              <option value="{{$cat->id}}">{{$cat->category}}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                  </div>
    

                  <div class="form-re text-center">   
                     <input type="submit" class="btn btn-red w175 m-auto" style="border-radius: var(--padding-box-30);
                     " value="Submit">
                 </div>               
               </form>
            </div>

     </div>
 </div>
 </div>


<!-- popup model user edit end  -->
<!-- user edit form end -->

<!-- popup model Candidate Data Popup section start   -->

<div class="modal accesspopupsection fade" id="accesspopup" tabindex="-1" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
         <div class="form-content text-center d-grid">
           <h5 class="modal-title">Naveen Sharma Access</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
            <div class="form-changepassword d-grid gap-3 accesslist">
                        <!-- <div class="student-document">
                            <h3>Cloud Computing</h3>         
                        </div>
                        <div class="student-document">
                           <h3>DevOps Engineering</h3>         
                       </div>
                    <div class="student-document">
                        <h3>Data Science & AI</h3>         
                    </div>
                    <div class="student-document">
                     <h3>Amazon Web Services(AWS)</h3>         
                    </div> -->
            </div>
     </div>
 </div>
 </div>
 
 
 
 
 
 
 
 
 <!-- popup model upload Pdf Start  -->
      <!-- Modal -->
      <div class="modal mymodel fade" id="uploadpdfmodel" tabindex="-1" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
               <div class="form-content text-center d-grid">
                  <h5 class="modal-title">Upload Pdf</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="form-changepassword">
                  <form action="{{Route('manual.pdf')}}" method="post" class="d-grid gap-3" autocomplete="off" enctype="multipart/form-data">
                      @csrf
                      <input type="hidden" name="category_id" id="custom_category_id">
                      <input type="hidden" name="course_id" id="custom_course_id">
                     <div class="form-re">
                        <button type="button" id="custom-button">
                           <div class="upload-excel text-center">
                               <input type="file" id="real-file" name="pdf_name" accept=".pdf">
                              <!--<input type="file" id="real-file" hidden="hidden" accept=".pdf">-->
                              
                                 <!--<img src="{{basepath('images/pdficon.svg')}}" alt="pdficon" class="m-auto" style="width: 30px;">-->
                              <!--<span id="custom-text">Drag &amp; drop files or Browse (Course Pdf)</span>-->
                           </div>
                      </button>
                     </div>
                     <div class="form-re text-center">   
                        <input type="submit" class="btn btn-red w175 m-auto" style="border-radius: var(--padding-box-30);">
                    </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <!-- popup model upload Pdf end  -->