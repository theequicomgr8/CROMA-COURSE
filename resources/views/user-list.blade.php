@extends('layout.app')
@section('main')
<div class="tab-content" id="pills-tabContent">
   <div class="tab-pane fade show active" id="pills-rankview" role="tabpanel" aria-labelledby="pills-rankview-tab">
      <!-- filter data here  -->
      <div class="filter-section">
         <img src="{{basepath('images/addusericon.svg')}}" alt="addusericon" class="img-fluid">

        <a class="admin-add-section" data-bs-toggle="modal" data-bs-target="#useraddtab">
         <h2>Add New User</h2>
         </a>
         
         
        </div>
      
    
      <!-- filter list tab section start end -->
      <div class="container">
         <div class="tab-content1" id="pills-tabContent">
            <table id="addnewuserdata" class="display addnewuserdata tabledesignmain" style="width: 100%;">
               <thead>
                  <tr>
                     <th><span>#</span></th>
                     <th><span>User Name</span></th>
                     <th><span>Email id</span></th>
                     <th><span>Mobile No.</span></th>
                     <th><span>Designation</span></th>
                     <th><span>Action</span></th>              
                     <th><span>Access</span></th>              
                  </tr>
               </thead>
            </table>
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
        var userTable=$("#addnewuserdata").DataTable({
            "serverSide":true,
            "processing":true,
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, 'All'],
            ],
            dom: 'Bfrtip',
            buttons: [
                ''
            ],
            "ajax": {
                "url" : '/user-data',
                "type":'GET',
                "dataType":'json',
                data: function(data){

                }
            },
            "columns":[
                {"data":"id"},
                {"data":"name"},
                {"data":"email"},
                {"data":"mobile"},
                {"data":"desigination"},
                {"data":"action"},
                {"data":"access"}
            ]
         });
        $("#filter_btn").click(function(e){
            e.preventDefault();
            userTable.draw();
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
@endsection