<!DOCTYPE html>
<html lang="en" >
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title> PDF</title>
    <style>
     @page {
  size: A4;
  margin:25px;
  padding: 0px;
  
}

        .img {
         width: 100%;
         }
    
         body
         {
            font-family: 'Montserrat', sans-serif; 
         }
         
         .pdfhedadingtext
         {
         padding: 0px 55px;
         }
           .main-heading-pdf
         {
         font-size: 22px;
         color: #00000;
         font-weight:700;
         padding: 0px 0px 0px 35px;
         display: flex;align-items: center;
         }
             
     
     
             
         .pdfhedadingtext h1{
           
         font-size: 16.4px;
         position: absolute;
         bottom: 31%;
         color: #bcbcbc;
         
         font-weight: 500;
         border-bottom: 2px solid #bcbcbc;
         width: fit-content;
         text-transform: capitalize;
         padding-bottom: 2px;
         }
        .pdfhedadingtext h2
         {
         position: absolute;
         bottom: 22.5%;
         width:525px;
         font-size: 32px;
         font-weight:700;
         line-height:0.8em;
         text-transform: uppercase;
         }
           .lain
         {
         width: 112px;
         height: 3px;
         background-color: #bcbec0;
         display:block;
         margin-top:5px;
         }
        
         .contentbodypdf > ul
         {
             padding:0px 0px 0px 137px;margin:0px;
         }
         .second-list {
    padding-left: 26px;
    padding-bottom: 7px !important;
}
         .contentbodypdf ul li
         {
              margin:0px;
               padding:0px 0px 0px 5px;
               font-size: 14px;
               color: #000000;
               position: relative;
         }
         .contentbodypdf > ul > li::before {
    left: -20px;
    color: #000000;
    font-size: 10px;
    content: '';
    display: block;
    height: 3px;
    width: 3px;
    background: currentColor;
    border-radius: 50%;
    position: absolute;
    top: 13.5px;
    transform: translateY(-50%);
}
         .second-list  li
         {
               margin:0px;
                     padding:0px 0px 0px 0px;
                     font-size: 14px;
                     height:15px;
                     line-height:15px;
                     color: #000000;
                     position: relative;
         }
         .second-list > li::before
         {
                 left: -15.5px;
    color: #000000;
    font-size: 10px;
    content: '';
    display: block;
    height: 3px;
    width: 3px;
    background: currentColor;
    border-radius: 50%;
    position: absolute;
    top: 11.6px;
    transform: translateY(-50%);
         }
         ul li {
    list-style-type: none;
    margin:0px;
    padding:0px;
}
.contentbodypdf
{
    display:block;
    margin:0px;
    padding:0px;
}

    </style>
</head>
<body>
    @php
    //dd($data[0]['course_id']);
    $getheader=App\Models\Template::where('course_id',$data[0]['course_id'])->first();
    $header_id=$getheader->header_id;
    $header=App\Models\Header::where('id',$header_id)->first();
    $headerary=explode(",",$header->header_pic);
    
    //$getcategory=App\Models\Category::where('id',$data[0]['category_id'])->first()->category;
    $getcategory=json_decode(file_get_contents('https://www.cromacampus.com/findcategory/'.$data[0]['category_id']), true);
    $getcategory=collect($getcategory);
    $getcategory=$getcategory['0']['category'];
    
    //$getcourse=App\Models\Course::where('id',$data[0]['course_id'])->first()->course_name;
    $getcourse=json_decode(file_get_contents("https://www.cromacampus.com/findCourse/".$data[0]['category_id']), true);
    $getcourse=collect($getcourse);
    $getcourse=$getcourse['0']['course_name'];
    @endphp
   <div class="headerpdf">
         <div class="pdfheadersection">
            
               @foreach($headerary as $key => $value)
               @if($key==0)
               <div class="img-pdf">
                <img src="{{basepath('header/'.$value)}}" alt="header" class="img">
                    <div class="pdfhedadingtext">
                   <h1>{{$getcategory}}<!--Master Program--></h1>
                   <h2>{{$getcourse}}</h2>
                </div>
               </div>
               @else
               <img src="{{basepath('header/'.$value)}}" alt="header" class="img">
               @endif
               
               @endforeach
            
            
         </div>
      </div>
      
            <!-- pdf table body section start html  -->
        <span class="bodypdf">
            
            
            @foreach($data as $value)
             @if($value['module_heading'])
            <span class="main-heading-pdf">{{$value['module_heading']}}</span>
            <span class="lain"></span>
            @endif
        <span class="contentbodypdf">
            @if($value['heading'])
                    <h3 style="
                       font-size: 18px;
                       text-transform: uppercase;
                       padding:8px 0px 5px 75px;
                       margin:0px;
                       color:#4c4c4c;
                       font-weight:600;
                       "><img style="width: 15px;margin-right:8px;" src="{{basepath('pdf/checkiconheading.png')}}" alt="checkiconheading">{{$value['heading']}}</h3>
            @endif
         
             
               
               <ul style="list-style:none">
                   
                    @if($value['sub_heading']) 
                    <li>
                    {{$value['sub_heading']}}
                    @endif
                    @if($value['child_heading'])
                      <ul class="second-list">
                          <li>{{$value['child_heading']}}</li>
                      </ul>
                    @endif
                   </li>
                   
               </ul>
           
                

         </span>
         
      @endforeach
      </span>
      <!-- pdf table body section end html  -->
      
      
            <!-- pdf table footer section start html  -->
            @php
    $footer_id=$getheader->footer_id;
    $footer=App\Models\Footer::where('id',$footer_id)->first();
    $footerary=explode(",",$footer->footer_pic);
    @endphp
    
      <div class="footerpdf">
          @foreach($footerary as $value)
         <img src="{{basepath('footer/'.$value)}}" alt="footer" class="img">
         @endforeach
      </div>
      

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
</body>
</html>