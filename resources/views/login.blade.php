<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/all.css">
      <link rel="stylesheet" href="{{basepath('css/bootstrap.min.css')}}">
      <!-- Style -->
      <link rel="stylesheet" href="{{basepath('css/style.css')}}">
      <link rel="stylesheet" href="{{basepath('css/responsive.css')}}">
      <link rel="stylesheet" href="{{basepath('css/select2.min.css')}}">
      <link rel="stylesheet" href="{{basepath('css/dataTables.min.css')}}">
      <link rel="stylesheet" href="{{basepath('css/buttons.dataTables.min.css')}}">
      <link rel="stylesheet" href="{{basepath('css/chosen.min.css')}}">
      <title>Course Curriculum Log In </title>
   </head>
   <body>
      <section class="justify-content-center align-items-center">
            
            <div class="login-section">
               <img src="{{basepath('images/circle-bg.svg')}}" alt="circle-bg">
            </div>
            
            <div class="loginform text-center">
               <img src="{{basepath('images/logocroma.svg')}}" alt="logocroma" class="img-fluid mb-3">
               <h1>Course Curriculum</h1>
               <h3>PDF Application</h3>
               <form  action="{{Route('login.check')}}" method="post" autocomplete="off">
                  @csrf
                  <img src="{{basepath('images/loginimageperson.png')}}" alt="loginimageperson" class="mb-4 img-fluid">
                  <div class="form-login">
                     <input type="text" name="name" class="my-control" id="exampleFormControlInput1" placeholder="User Name">
                     <img src="{{basepath('images/person-icon.svg')}}" alt="person">
                  </div>
                  <div class="form-login">
                     <input type="password" name="password" class="my-control" id="exampleFormControlInput1" placeholder="Password">
                     <img src="{{basepath('images/login-icon.svg')}}" alt="login" style=" top:11px;">
                  </div>
                  <div class="text-start form-login">
                     <input type="checkbox" class="form-check-input" id="exampleCheck1">
                     <label class="form-check-label" for="exampleCheck1">Remember Me</label>
                  </div>
                  <input type="submit" class="btn btn-red mb-1" value="Login">
                  <a href="">Forget Your Password</a>
               </form>
            </div>   
    

      </section>
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
<!-- popup model here  -->
<!-- popup model change password  -->
<!-- Modal -->
<div class="modal mymodel fade" id="changepassword" tabindex="-1" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="form-content text-center d-grid m-auto pb-4">
            <h5 class="modal-title">Reset Password</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="form-changepassword">
            <form action="" method="post" class="d-grid gap-3" autocomplete="off">
               <div class="form-re">
                  <input type="password" class="my-from-control"  placeholder="Old Password" >
               </div>
               <div class="form-re">
                  <input type="password" class="my-from-control"  placeholder="New Password">
                  <i class="fa-light fa-circle-check"></i>
               </div>
               <div class="form-re">
                  <input type="password" class="my-from-control "  placeholder="Confirm Password">
                  <i class="fa-light fa-circle-xmark"></i>                 
               </div>
               <div class="form-re text-center">
                  <button type="button" class="btn btn-blue w175 m-auto">Update</button>
               </div>
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
            <div class="form-changepassword">
               <form>
                  <div class="form-login mb-0">
                     <div class="row">
                        <div class="col-lg-12">
                           <label class="form-label">User Name</label>
                           <input type="text" class="my-from-control" id="" placeholder="Enter Your Name">

                        </div>                      
        
                     </div>
                  </div>
                  <div class="form-login mb-0">
                     <div class="row">
                        <div class="col-lg-6">
                           <label class="form-label">Email ID</label>
                           <input type="text" class="my-from-control" id="" placeholder="Enter Email Id">
                        </div>
                        <div class="col-lg-6">
                           <label class="form-label">Mobile No.</label>
                           <input type="text" class="my-from-control" id="" placeholder="Enter Mobile No.">
                        </div>
                      
                     </div>
                  </div>
                  <div class="form-login mb-0">
                     <div class="row">
                        <div class="col-lg-6">
                           <label class="form-label">Designation</label>
                           <select class="my-from-control selectcol" aria-label="Select Priority">
                              <option value="">Select Priority</option>
                              <option>#1</option>
                              <option>#2</option>
                              <option>#3</option>
                              <option>#4</option>
                           </select>
                        </div>
                        <div class="col-lg-6">
                           <label class="form-label">Password</label>
                           <input type="text" class="my-from-control" id="" placeholder="Enter Password">
                        </div>
                      
                     </div>
                  </div>
  
                  <div class="form-login mb-0">
                     <div class="row">
                        <div class="col-lg-12">
                           <label class="form-label">Access</label>
                           <select data-placeholder="Access Here..." multiple class="chosen-select" name="test">
                              <option value=""></option>
                              <option>Cloud Computing</option>
                              <option>DevOps Engineering</option>
                              <option>Data Science & AI</option>
                              <option>Amazon Web Services(AWS)</option>
                           </select>
                        </div>
                     </div>
                  </div>
    

                  <div class="form-re text-center">   
                     <button type="button" class="btn btn-red w175 m-auto" style="border-radius: var(--padding-box-30);
                     ">Submit</button>
                 </div>               
               </form>
            </div>

     </div>
 </div>
 </div>

<!-- popup model Candidate section end   -->

<!-- popup model Candidate Data Popup section start   -->

<div class="modal accesspopupsection fade" id="accesspopup" tabindex="-1" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
         <div class="form-content text-center d-grid">
           <h5 class="modal-title">Naveen Sharma Access</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
            <div class="form-changepassword d-grid gap-3">
                        <div class="student-document">
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
                    </div>
            </div>
     </div>
 </div>
 </div>

<!-- popup model Candidate Data Popup section End   -->
<script src="{{basepath('js/jquery-3.3.1.min.js')}}"></script>
<script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="{{basepath('js/bootstrap.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="{{basepath('js/dataTables.min.js')}}"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/ashl1/datatables-rowsgroup@fbd569b8768155c7a9a62568e66a64115887d7d0/dataTables.rowsGroup.js"></script>

<!-- common js here all   -->

<script>
   $(document).ready(function(){
   
   $("select").change(function(){
     if ($(this).val()=="") $(this).css({color: "#aaa"});
     else $(this).css({color: "#000"});
   });
   $('.selectcol').select2();
   
   });	
       
</script>
<script>
   $(document).ready(function(){
   function demo(){
      $('.dt-buttons,.dataTables_filter').wrapAll('<div class="tablefilter"><div class="row"><div class="col-lg-12 col-lg-12 mb-3 d-flex justify-content-between data-filtertab"></div></div></div>');
   }
   demo();
   $( ".dataTables_filter label" ).append( '<div class="iconsearch"><i class="fa-regular fa-magnifying-glass"></i></div>' );
   // $( ".dt-buttons" ).before( '<div class="filter-section"><a href=""><img src="images/filter.svg" alt="filter" class="img-fluid me-2">Filter</a><div>' );
   // $(".dataTables_info").prependTo(".dataTables_paginate");
   $(".filter-section").prependTo(".data-filtertab");
   $(".filter-data-list").appendTo(".tablefilter");
   $('.dataTables_info').wrapAll('<div class="container"><div class="row d-flex align-items-center justify-content-between"><div class="col-lg-12 col-lg-12"></div></div></div>');
   
   $('.dataTables_paginate').wrapAll('<div class="container"><div class="row d-flex align-items-center justify-content-between"><div class="col-lg-12 col-lg-12 panigation"></div></div></div>');
   
   
   
   }); 
   
   
</script>  

   </body>
</html>