<!DOCTYPE html>
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
        
        <div class="main-site">
            @include('layout.header')

            @yield('main')

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
<script src="{{basepath('js/custom.js')}}"></script>
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
   // $(document).ready(function(){
   // function demo(){
   //    $('.dt-buttons,.dataTables_filter').wrapAll('<div class="tablefilter"><div class="row"><div class="col-lg-12 col-lg-12 mb-3 d-flex justify-content-between data-filtertab"></div></div></div>');
   // }
   // demo();
   // $( ".dataTables_filter label" ).append( '<div class="iconsearch"><i class="fa-regular fa-magnifying-glass"></i></div>' );
   // $(".filter-section").prependTo(".data-filtertab");
   // $(".filter-data-list").appendTo(".tablefilter");
   // $('.dataTables_info').wrapAll('<div class="container"><div class="row d-flex align-items-center justify-content-between"><div class="col-lg-12 col-lg-12"></div></div></div>');
   
   // $('.dataTables_paginate').wrapAll('<div class="container"><div class="row d-flex align-items-center justify-content-between"><div class="col-lg-12 col-lg-12 panigation"></div></div></div>');
   
   
   
   // }); 
   
   
</script>

    
    @yield('script')

</body>
</html>