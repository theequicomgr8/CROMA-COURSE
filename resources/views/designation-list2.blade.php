@extends('layout.app')
@section('main')
 <!-- table here  -->
 <div class="tab-content1" id="pills-tabContent" >
   <div class="tab-pane fade show active" id="pills-rankview" role="tabpanel" aria-labelledby="pills-rankview-tab">
   
    <div class="container">
        <div class="tab-list-flex">
           <div class="tabbox-css create-new-course-curricullumform">
            <h3>Create New Course Curriculum</h3>
               <div class="form-changepassword">
                  <form>
                     <div class="form-login mb-0">
                        <div class="row">
                           <div class="col-lg-12">
                              <label class="form-label">Course</label>
                              <select class="my-from-control selectcol" aria-label="Select Course">
                                 <option value="">Select Course</option>
                                 <option>#1</option>
                                 <option>#2</option>
                                 <option>#3</option>
                                 <option>#4</option>
                              </select>
                           </div>
                         
                        </div>
                     </div>
       
                     <div class="form-login mb-0">
                        <div class="row">
                           <div class="col-lg-12">
                              <label class="form-label">Category</label>
                              <select class="my-from-control selectcol" aria-label="Select Category">
                                 <option value="">Select Category</option>
                                 <option>#1</option>
                                 <option>#2</option>
                                 <option>#3</option>
                                 <option>#4</option>
                              </select>
                           </div>
                         
                        </div>
                     </div>

                     <div class="form-login mb-0">
                        <div class="row">
                           <div class="col-lg-12">
                              <label class="form-label">Header</label>
                              <select class="my-from-control selectcol" aria-label="Select Header ">
                                 <option value="">Select Header</option>
                                 <option>#1</option>
                                 <option>#2</option>
                                 <option>#3</option>
                                 <option>#4</option>
                              </select>
                           </div>
                         
                        </div>
                     </div>

                     <div class="form-login mb-0">
                        <div class="row">
                           <div class="col-lg-12">
                              <label class="form-label">Footer</label>
                              <select class="my-from-control selectcol" aria-label="Select Footer">
                                 <option value="">Select Footer</option>
                                 <option>#1</option>
                                 <option>#2</option>
                                 <option>#3</option>
                                 <option>#4</option>
                              </select>
                           </div>
                         
                        </div>
                     </div>
     
                     <div class="form-login mb-0 mt-1">
                        <div class="row">
                           <div class="col-lg-12">
                              <button type="button" id="custom-button">

                              <div class="upload-excel text-center">
                                 <input type="file" id="real-file" hidden="hidden"  accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
                                    <img src="{{basepath('images/uploadexcicon.svg')}}" alt="uploadexcicon" class="m-auto">
                                 <span id="custom-text">Drag & drop files or Browse (Course Content)</span>
                              </div>                          
                           </button>

                           </div>
                         
                        </div>
                     </div>

       
   
                     <div class="form-re text-center">   
                        <button type="button" class="btn btn-red w175 m-auto" style="border-radius: var(--padding-box-30);
                        ">Create </button>
                    </div>               
                  </form>
               </div>
           </div>
           <div class="pdfviewerbox">
            
            <embed src= "https://www.cromacampus.com/croma_campus_brochure.pdf#toolbar=0&navpanes=0&scrollbar=0" width= "100%" height= "500px" frameborder="0">
              <div class="text-center downloadpdf mt-3">
               <a href="" class="btn btn-third">
                  <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <g clip-path="url(#clip0_352_1979)">
                  <path d="M10.1111 13H2.88888C2.11728 13 1.39183 12.6995 0.846151 12.1538C0.300501 11.6082 0 10.8827 0 10.1111V9.38884C0 8.98995 0.323333 8.66659 0.722226 8.66659C1.12112 8.66659 1.44445 8.98995 1.44445 9.38884V10.1111C1.44445 10.4969 1.59472 10.8596 1.86749 11.1324C2.14034 11.4053 2.50306 11.5555 2.88888 11.5555H10.1111C10.4969 11.5555 10.8596 11.4053 11.1324 11.1324C11.4053 10.8596 11.5555 10.4969 11.5555 10.1111V9.38884C11.5555 8.98995 11.8789 8.66659 12.2777 8.66659C12.6766 8.66659 13 8.98995 13 9.38884V10.1111C13 10.8827 12.6995 11.6081 12.1538 12.1538C11.6081 12.6995 10.8827 13 10.1111 13ZM6.49999 10.1111C6.40008 10.1111 6.30497 10.0908 6.21843 10.0541C6.1377 10.02 6.06184 9.97047 5.99546 9.90565C5.99544 9.90563 5.99544 9.90561 5.99541 9.90561C5.99493 9.90515 5.99445 9.90467 5.99397 9.90419C5.99385 9.90409 5.99369 9.90392 5.99357 9.90379C5.99316 9.90344 5.99281 9.90306 5.99243 9.90268C5.99218 9.90243 5.99195 9.90222 5.9917 9.90195C5.99145 9.90169 5.99112 9.90137 5.99089 9.90117C5.99039 9.90066 5.98983 9.90011 5.98933 9.8996L3.10042 7.01067C2.81839 6.72864 2.81839 6.27134 3.10042 5.98928C3.38246 5.70725 3.83978 5.70722 4.12181 5.98928L5.77779 7.64525V0.722226C5.77776 0.323333 6.10109 0 6.49999 0C6.89888 0 7.22224 0.323333 7.22224 0.722226V7.64523L8.87819 5.98928C9.16019 5.70725 9.61757 5.70725 9.89958 5.98928C10.1816 6.27131 10.1816 6.72864 9.89958 7.01067L7.01067 9.89955C7.01017 9.90005 7.00961 9.90061 7.00911 9.90111C7.00883 9.90137 7.00853 9.90169 7.0083 9.9019C7.00805 9.90217 7.00782 9.90238 7.00757 9.90263C7.00721 9.90303 7.00681 9.90339 7.00646 9.90374C7.00633 9.90386 7.00615 9.90404 7.00603 9.90414C7.00557 9.90462 7.00509 9.9051 7.00461 9.90555C7.00459 9.90555 7.00459 9.90558 7.00456 9.90561C6.99662 9.91335 6.98857 9.92087 6.98034 9.92818C6.91987 9.98212 6.85251 10.0242 6.78129 10.0542C6.78104 10.0543 6.78083 10.0544 6.78058 10.0545C6.7803 10.0546 6.78008 10.0548 6.7798 10.0548C6.69372 10.0911 6.59921 10.1111 6.49999 10.1111Z" fill="#02735C"/>
                  </g>
                  <defs>
                  <clipPath id="clip0_352_1979">
                  <rect width="13" height="13" fill="white"/>
                  </clipPath>
                  </defs>
                  </svg>
                   Download PDF</a>

              </div> 
           </div>
     </div>
   </div>
</div>


      
@include('layout.footer')
@endsection

@section('script')

<script>
   $(".chosen-select").chosen({
     no_results_text: "Oops, nothing found!"
   })
</script>







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
@endsection