@extends('layout.app')
@section('main')
<style>
    .mouseblock {
        pointer-events: none;
    }
</style>
<div class="container">
         <div class="row">
            <div class="col-lg-12">
               <div class="tab-content1" id="pills-tabContent">
                  <div class="tab-pane fade show active" id="pills-rankview" role="tabpanel" aria-labelledby="pills-rankview-tab">
                     <!-- filter data here  -->
                     <div class="filter-section">
                        <img src="{{basepath('images/newcurriculumicon.svg')}}" alt="newcurriculumicon" class="img-fluid">
                        <a class="admin-add-section" href="{{Route('curriculm.create')}}">
                           <h2>Create New Curriculum</h2>
                        </a>
                     </div>
                     <!-- filter list tab section start end -->
                        <div class='accordion' id='accordionExample'>
                           <table id="listpdfdata" class="listpdfdata dataTable" style="width: 100%;">
                              <thead class="d-none">
                                 <tr>
                                    <th><span>#</span></th>
                                 </tr>
                              </thead>    
                              <tbody>
                                  @foreach($data as $key => $value) 
                                  @php
                                  
                                  //$getcourse=App\Models\Course::where('category',$value['category_id'])->groupBy('course_name')->orderBy('id','desc')->get();
                                  
                                  
                                  $getcourse=json_decode(file_get_contents("https://www.cromacampus.com/findCourse/".$value['category_id']), true);
                                  $getcourse=collect($getcourse);
                                  
                                  
                                  $count=count($getcourse);
                                  
                                  
                                  $countfees=json_decode(file_get_contents("https://www.cromacampus.com/countfees/".$value['category_id']), true);
                                  $countfees=collect($countfees);
                                  $countfees=count($countfees);
                                  
                                  
                                  $avcourse=App\Models\Template::where('category_id',$value['category_id'])->count();
                                  $manavcourse=App\Models\Manualpdf::where('category_id',$value['category_id'])->count();
                                  $totalavlablecourse=$avcourse+$manavcourse;
                                  @endphp
                                 <tr>
                                    <td>
                                       <div class="accordion-item"> <h2 class="accordion-header" id="headingOne{{$key}}">
                                          <div class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{$key}}" aria-expanded="true" aria-controls="collapseOne{{$key}}">
                                              <span class="">{{$value['category_name']}}</span>
                                              <ul class="list-cri">
                                                  <li>Total: {{$count}}</li>
                                                  <li>Available: {{$totalavlablecourse}}</li>
                                                  <li>Total Fees Updated: {{$countfees}}</li>
                                              </ul>
                                          </div> </h2>
                                          <div id="collapseOne{{$key}}" class="accordion-collapse collapse" aria-labelledby="headingOne{{$key}}" data-bs-parent="#accordionExample">
                                              <div class="accordion-body">
                                                  
                                                  @foreach($getcourse as $list)
                                                  
                                                    @php
                                                    $templates=App\Models\Template::where('course_id',$list['id'])->where('category_id',$value['category_id'])->first();
                                                    if(!empty($templates)){
                                                        $templates=$templates->file_name;
                                                        $pdficon="pdficon.svg";
                                                        $mouseblock='mouseblock'; //if excel upload then manual section disabled
                                                        $dis='';  //if excel upload the excel download otherwife disabled
                                                        $downloadicon='downloadicon';
                                                        
                                                        $downloadicon2='downloadicongreen';
                                                        
                                                        //if excel uploaded then below link add for pdf view
                                                        $pdfview='pdf-view/'.$value['category_id'].'/'.$list['id'];
                                                        
                                                    }else{
                                                       $templates="";
                                                       $mouseblock='';
                                                       $dis='mouseblock';
                                                       $downloadicon='downloadicon';
                                                       $downloadicon2='downloadicon';
                                                       $getpdficon=App\Models\Manualpdf::where('category_id',$value['category_id'])->where('course_id',$list['id'])->first();
                                                       if(!empty($getpdficon)){
                                                            $pdficon="pdficon.svg";
                                                            $downloadicon='downloadicongreen';
                                                            //if manual pdf uploaded then below link add for pdf view
                                                            $pdfview='https://course.cromacampus.com/public/manual_pdf/'.$getpdficon->pdf_name;
                                                       }else{
                                                            $pdficon="pdficonblack.svg";
                                                            $pdfview='';
                                                       }
                                                       
                                                    }
                                                    
                                                    //if pdf download any way then manual pdf upload section block
                                                    if($pdfview==''){
                                                        $blk='';
                                                    }else{
                                                        $blk='mouseblock';
                                                    }
                                                    
                                                    $getmanualpdf=App\Models\Manualpdf::where('category_id',$value['category_id'])->where('course_id',$list['id'])->first();
                                                    $getmanualpdf=$getmanualpdf->pdf_name ?? '';
                                                    
                                                    
                                                    @endphp
                                                  <div class="list-curriculum">
                                                      <div class="pdfname"> <h2> <img src="{{basepath('images/'.$pdficon)}}" alt="pdficon" title="21-12-2023"> {{$list['course_name']}} </h2>
                                                      </div>
                                                      <div class="download-pdfbox">
                                                          <div class="fees-updatedsection">
                                                             <form id="myform">
                                                                      <!--<input type="hidden" name="courseID" id="courseID" value="{{$list['id']}}">-->
                                                                      <input type="text" id="fees_amount{{$list['id']}}"  name="fees_amount" value="{{$list['total_amount']}}" readonly>
                                                                      <span>₹</span>
                                                                     <ul> 
                                                                      <li>
                                                                      <a title="21-12-2023" class="fees_submit mouseblock submit{{$list['id']}}" data-courseID="{{$list['id']}}" > 
                                                                      <img src="{{basepath('images/sallerycheckgreenicon.svg')}}" alt="sallerycheckgreenicon"> </a>
                                                                      
                                                                      <a data-bs-toggle="modal" data-bs-target="#" class="feesedit" data-courseID="{{$list['id']}}"> 
                                                                      <img src="{{basepath('images/editicon.svg')}}" alt="editicon" class="feesedit" data-courseID="{{$list['id']}}" style="margin-top: -3px;"> </a>
                                                                      </li>
                                                                  </ul>
                                                             </form>
                                                          </div>
                                                          <ul>
                                    
                                                              <li> <a data-bs-toggle="modal" data-bs-target="#uploadpdfmodel" class="custom_upload {{$mouseblock}} {{$blk}}" data-category="{{$value['category_id']}}" data-course="{{$list['id']}}"> <img src="{{basepath('images/uploadicon.svg')}}" alt="uploadicon"> </a> <a href="{{basepath('manual_pdf/'.$getmanualpdf)}}" class="{{$mouseblock}} " target="_blank"> <img src="{{basepath('images/'.$downloadicon.'.svg')}}" alt="downloadicon"> </a> </li>
                                                              <li> <a href="{{basepath('excel/'.$templates)}}" target="_blank" class="{{$dis}}"> <img src="{{basepath('images/excelicon.svg')}}" alt="excelicon"> </a> <a href="{{$pdfview}}" target="_blank"> <img src="{{basepath('images/viewicon.svg')}}" alt="viewicon"> </a> <a href="{{Route('curriculm.edit',[$list['id']])}}" class="{{$dis}}"> <img src="{{basepath('images/editicon.svg')}}" alt="editicon"> </a> </li>
                                                              <li> <a href="/pdf-download/{{$value['category_id']}}/{{$list['id']}}" target="_blank" class="{{$dis}}"> <img src="{{basepath('images/'.$downloadicon2.'.svg')}}" alt="downloadicon"> </a> <a href="{{Route('curriculm.delete',[$value['category_id'],$list['id']])}}"> <img src="{{basepath('images/deleteicon.svg')}}" alt="deleteicon"> </a> </li>
                                                          </ul>
                                                      </div>
                                                  </div>
                                                  @endforeach
                                                  
                                                  <!--<div class="list-curriculum">
                                                      <div class="pdfname"> <h2> <img src="images/pdficonblack.svg" alt=""> pdficonCroma Campus - Cloud Computing Training Curriculum </h2>
                                                      </div>
                                                      <div class="download-pdfbox">
                                                          <ul>
                                                              <li> <a data-bs-toggle="modal" data-bs-target="#uploadpdfmodel"> <img src="images/uploadicon.svg" alt="uploadicon"> </a> <a href=""> <img src="images/downloadicongreen.svg" alt="downloadicon"> </a> </li>
                                                              <li> <a href=""> <img src="images/excelicon.svg" alt="excelicon"> </a> <a href=""> <img src="images/viewicon.svg" alt="viewicon"> </a> <a href="edit-new-course-curriculum.html"> <img src="images/editicon.svg" alt="editicon"> </a> </li>
                                                              <li> <a href=""> <img src="images/downloadicongreen.svg" alt="downloadicon"> </a> <a href=""> <img src="images/deleteicon.svg" alt="deleteicon"> </a> </li>
                                                          </ul>
                                                      </div>
                                                  </div>
                                                  <div class="list-curriculum">
                                                      <div class="pdfname"> <h2> <img src="images/pdficon.svg" alt=""> pdficonCroma Campus - Cloud Computing Training Curriculum </h2>
                                                      </div>
                                                      <div class="download-pdfbox">
                                                          <ul>
                                                              <li> <a data-bs-toggle="modal" data-bs-target="#uploadpdfmodel"> <img src="images/uploadicon.svg" alt="uploadicon"> </a> <a href=""> <img src="images/downloadicongreen.svg" alt="downloadicon"> </a> </li>
                                                              <li> <a href=""> <img src="images/excelicon.svg" alt="excelicon"> </a> <a href=""> <img src="images/viewicon.svg" alt="viewicon"> </a> <a href="edit-new-course-curriculum.html"> <img src="images/editicon.svg" alt="editicon"> </a> </li>
                                                              <li> <a href=""> <img src="images/downloadicongreen.svg" alt="downloadicon"> </a> <a href=""> <img src="images/deleteicon.svg" alt="deleteicon"> </a> </li>
                                                          </ul>
                                                      </div>
                                                  </div>
                                                  <div class="list-curriculum">
                                                      <div class="pdfname"> <h2> <img src="images/pdficonblack.svg" alt=""> pdficonCroma Campus - Cloud Computing Training Curriculum </h2>
                                                      </div>
                                                      <div class="download-pdfbox">
                                                          <ul>
                                                              <li> <a data-bs-toggle="modal" data-bs-target="#uploadpdfmodel"> <img src="images/uploadicon.svg" alt="uploadicon"> </a> <a href=""> <img src="images/downloadicongreen.svg" alt="downloadicon"> </a> </li>
                                                              <li> <a href=""> <img src="images/excelicon.svg" alt="excelicon"> </a> <a href=""> <img src="images/viewicon.svg" alt="viewicon"> </a> <a href="edit-new-course-curriculum.html"> <img src="images/editicon.svg" alt="editicon"> </a> </li>
                                                              <li> <a href=""> <img src="images/downloadicon.svg" alt="downloadicon"> </a> <a href=""> <img src="images/deleteicon.svg" alt="deleteicon"> </a> </li>
                                                          </ul>
                                                      </div>
                                                  </div>-->
                                              </div>
                                          </div>
                                      </div>
                                    </td>
                                 </tr>
                                 @endforeach
                                 <!--<tr>
                                    <td>
                                       <div class="accordion-item"> <h2 class="accordion-header" id="headingtwo">
                                          <div class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsetwo" aria-expanded="true" aria-controls="collapsetwo">
                                              <span class="">DevOps Engineering</span>
                                              <ul class="list-cri">
                                                  <li>Total: 6</li>
                                                  <li>Available: 4</li>
                                              </ul>
                                          </div> </h2>
                                          <div id="collapsetwo" class="accordion-collapse collapse" aria-labelledby="headingtwo" data-bs-parent="#accordionExample">
                                              <div class="accordion-body">
                                                  <div class="list-curriculum">
                                                      <div class="pdfname"> <h2><img src="images/pdficon.svg" alt=""> pdficonCroma Campus - Cloud Computing Training Curriculum </h2>
                                                      </div>
                                                      <div class="download-pdfbox">
                                                          <ul>
                                                              <li><a data-bs-toggle="modal" data-bs-target="#uploadpdfmodel"><img src="images/uploadicon.svg" alt="uploadicon"></a><a href=""><img src="images/downloadicon.svg" alt="downloadicon"></a></li>
                                                              <li><a href=""><img src="images/excelicon.svg" alt="excelicon"></a><a href=""><img src="images/viewicon.svg" alt="viewicon"></a><a href="edit-new-course-curriculum.html"> <img src="images/editicon.svg" alt="editicon"> </a></li>
                                                              <li><a href=""><img src="images/downloadicon.svg" alt="downloadicon"></a><a href=""><img src="images/deleteicon.svg" alt="deleteicon"></a></li>
                                                          </ul>
                                                      </div>
                                                  </div>
                                                  <div class="list-curriculum">
                                                      <div class="pdfname"> <h2><img src="images/pdficonblack.svg" alt=""> pdficonCroma Campus - Cloud Computing Training Curriculum </h2>
                                                      </div>
                                                      <div class="download-pdfbox">
                                                          <ul>
                                                              <li><a data-bs-toggle="modal" data-bs-target="#uploadpdfmodel"><img src="images/uploadicon.svg" alt="uploadicon"></a><a href=""><img src="images/downloadicongreen.svg" alt="downloadicon"></a></li>
                                                              <li><a href=""><img src="images/excelicon.svg" alt="excelicon"></a><a href=""><img src="images/viewicon.svg" alt="viewicon"></a><a href="edit-new-course-curriculum.html"> <img src="images/editicon.svg" alt="editicon"> </a></li>
                                                              <li><a href=""><img src="images/downloadicongreen.svg" alt="downloadicon"></a><a href=""><img src="images/deleteicon.svg" alt="deleteicon"></a></li>
                                                          </ul>
                                                      </div>
                                                  </div>
                                                  <div class="list-curriculum">
                                                      <div class="pdfname"> <h2><img src="images/pdficon.svg" alt=""> pdficonCroma Campus - Cloud Computing Training Curriculum </h2>
                                                      </div>
                                                      <div class="download-pdfbox">
                                                          <ul>
                                                              <li><a data-bs-toggle="modal" data-bs-target="#uploadpdfmodel"><img src="images/uploadicon.svg" alt="uploadicon"></a><a href=""><img src="images/downloadicongreen.svg" alt="downloadicon"></a></li>
                                                              <li><a href=""><img src="images/excelicon.svg" alt="excelicon"></a><a href=""><img src="images/viewicon.svg" alt="viewicon"></a><a href="edit-new-course-curriculum.html"> <img src="images/editicon.svg" alt="editicon"> </a></li>
                                                              <li><a href=""><img src="images/downloadicongreen.svg" alt="downloadicon"></a><a href=""><img src="images/deleteicon.svg" alt="deleteicon"></a></li>
                                                          </ul>
                                                      </div>
                                                  </div>
                                                  <div class="list-curriculum">
                                                      <div class="pdfname"> <h2><img src="images/pdficonblack.svg" alt=""> pdficonCroma Campus - Cloud Computing Training Curriculum </h2>
                                                      </div>
                                                      <div class="download-pdfbox">
                                                          <ul>
                                                              <li><a data-bs-toggle="modal" data-bs-target="#uploadpdfmodel"><img src="images/uploadicon.svg" alt="uploadicon"></a><a href=""><img src="images/downloadicongreen.svg" alt="downloadicon"></a></li>
                                                              <li><a href=""><img src="images/excelicon.svg" alt="excelicon"></a><a href=""><img src="images/viewicon.svg" alt="viewicon"></a><a href="edit-new-course-curriculum.html"> <img src="images/editicon.svg" alt="editicon"> </a></li>
                                                              <li><a href=""><img src="images/downloadicon.svg" alt="downloadicon"></a><a href=""><img src="images/deleteicon.svg" alt="deleteicon"></a></li>
                                                          </ul>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                    </td>
                                 </tr>

                                 <tr>
                                    <td>
                                       <div class="accordion-item"> <h2 class="accordion-header" id="headingthird">
                                          <div class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsethird" aria-expanded="true" aria-controls="collapsethird">
                                              <span class="">Amazon Web Services(AWS)</span>
                                              <ul class="list-cri">
                                                  <li>Total: 6</li>
                                                  <li>Available: 4</li>
                                              </ul>
                                          </div> </h2>
                                          <div id="collapsethird" class="accordion-collapse collapse" aria-labelledby="headingthird" data-bs-parent="#accordionExample">
                                              <div class="accordion-body">
                                                  <div class="list-curriculum">
                                                      <div class="pdfname"> <h2><img src="images/pdficon.svg" alt=""> pdficonCroma Campus - Cloud Computing Training Curriculum </h2>
                                                      </div>
                                                      <div class="download-pdfbox">
                                                          <ul>
                                                              <li><a data-bs-toggle="modal" data-bs-target="#uploadpdfmodel"><img src="images/uploadicon.svg" alt="uploadicon"></a><a href=""><img src="images/downloadicon.svg" alt="downloadicon"></a></li>
                                                              <li><a href=""><img src="images/excelicon.svg" alt="excelicon"></a><a href=""><img src="images/viewicon.svg" alt="viewicon"></a><a href="edit-new-course-curriculum.html"> <img src="images/editicon.svg" alt="editicon"> </a></li>
                                                              <li><a href=""><img src="images/downloadicon.svg" alt="downloadicon"></a><a href=""><img src="images/deleteicon.svg" alt="deleteicon"></a></li>
                                                          </ul>
                                                      </div>
                                                  </div>
                                                  <div class="list-curriculum">
                                                      <div class="pdfname"> <h2><img src="images/pdficonblack.svg" alt=""> pdficonCroma Campus - Cloud Computing Training Curriculum </h2>
                                                      </div>
                                                      <div class="download-pdfbox">
                                                          <ul>
                                                              <li><a data-bs-toggle="modal" data-bs-target="#uploadpdfmodel"><img src="images/uploadicon.svg" alt="uploadicon"></a><a href=""><img src="images/downloadicongreen.svg" alt="downloadicon"></a></li>
                                                              <li><a href=""><img src="images/excelicon.svg" alt="excelicon"></a><a href=""><img src="images/viewicon.svg" alt="viewicon"></a><a href="edit-new-course-curriculum.html"> <img src="images/editicon.svg" alt="editicon"> </a></li>
                                                              <li><a href=""><img src="images/downloadicongreen.svg" alt="downloadicon"></a><a href=""><img src="images/deleteicon.svg" alt="deleteicon"></a></li>
                                                          </ul>
                                                      </div>
                                                  </div>
                                                  <div class="list-curriculum">
                                                      <div class="pdfname"> <h2><img src="images/pdficon.svg" alt=""> pdficonCroma Campus - Cloud Computing Training Curriculum </h2>
                                                      </div>
                                                      <div class="download-pdfbox">
                                                          <ul>
                                                              <li><a data-bs-toggle="modal" data-bs-target="#uploadpdfmodel"><img src="images/uploadicon.svg" alt="uploadicon"></a><a href=""><img src="images/downloadicongreen.svg" alt="downloadicon"></a></li>
                                                              <li><a href=""><img src="images/excelicon.svg" alt="excelicon"></a><a href=""><img src="images/viewicon.svg" alt="viewicon"></a><a href="edit-new-course-curriculum.html"> <img src="images/editicon.svg" alt="editicon"> </a></li>
                                                              <li><a href=""><img src="images/downloadicongreen.svg" alt="downloadicon"></a><a href=""><img src="images/deleteicon.svg" alt="deleteicon"></a></li>
                                                          </ul>
                                                      </div>
                                                  </div>
                                                  <div class="list-curriculum">
                                                      <div class="pdfname"> <h2><img src="images/pdficonblack.svg" alt=""> pdficonCroma Campus - Cloud Computing Training Curriculum </h2>
                                                      </div>
                                                      <div class="download-pdfbox">
                                                          <ul>
                                                              <li><a data-bs-toggle="modal" data-bs-target="#uploadpdfmodel"><img src="images/uploadicon.svg" alt="uploadicon"></a><a href=""><img src="images/downloadicongreen.svg" alt="downloadicon"></a></li>
                                                              <li><a href=""><img src="images/excelicon.svg" alt="excelicon"></a><a href=""><img src="images/viewicon.svg" alt="viewicon"></a><a href="edit-new-course-curriculum.html"> <img src="images/editicon.svg" alt="editicon"> </a></li>
                                                              <li><a href=""><img src="images/downloadicon.svg" alt="downloadicon"></a><a href=""><img src="images/deleteicon.svg" alt="deleteicon"></a></li>
                                                          </ul>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                    </td>
                                 </tr>-->
                              </tbody>                        
                           </table>
                        </div>
                        
                        
                        
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
<script>
   // $('#addnewuserdata').DataTable({
   //     ajax: '/user-data',
   //     serverSide: true, 
   //     lengthMenu: [
   //     [ 10, 25, 50, -1 ],
   //     [ '10', '25', '50', 'all' ]
   // ],          
   //     dom: 'Bfrtip',
   //     buttons: [
   //           '',
   //     ]
   // });
</script>
<script>
        //  $('#listpdfdata').DataTable({
        //      ajax: '/curriculm-data',
        //      serverSide: true, 
         
        //      lengthMenu: [
        //      [ 10, 25, 50, -1 ],
        //      [ '10', '25', '50', 'all' ]
        //  ],          
        //      dom: 'Bfrtip',
        //      buttons: [
        //           '',
        //      ]
        //  });
      </script>

<script>
        var userTable=$("#listpdfdata_").DataTable({
            "serverSide":true,
            "processing":true,
            lengthMenu: [
                [100, 25, 50, -1],
                [100, 25, 50, 'All'],
            ],
            dom: 'Bfrtip',
            buttons: [
                ''
            ],
            "ajax": {
                "url" : '/curriculm-data',
                "type":'GET',
                "dataType":'json',
                data: function(data){

                }
            },
            "columns":[
                {"data":"category"}
            ]
         });
        $("#filter_btn").click(function(e){
            e.preventDefault();
            userTable.draw();
          });

      </script>


<script>
         $('#listpdfdata').DataTable({
            //  ajax: 'listpdfdata.php',
             serverSide: false, 
         //        "sScrollX": "100%",
         //   "sScrollXInner": "160%",
         
             lengthMenu: [
             [ 1000, 25, 50, -1 ],
             [ '1000', '25', '50', 'all' ]
         ],          
             dom: 'Bfrtip',
             buttons: [
                   '',
             ]
         });
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

<script>
    $(document).on("click",".custom_upload",function(){
        
        var category_id=$(this).attr('data-category');
        var course_id=$(this).attr('data-course');
        $("#custom_category_id").attr('value',category_id);
        $("#custom_course_id").attr('value',course_id);
    });
</script>
@endsection