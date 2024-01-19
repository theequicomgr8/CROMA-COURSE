<!DOCTYPE html>
<html lang="en" >
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title> PDF</title>
    <style>
        
        .img {
         width: 100%;
         height:100%;
         }
         body
         {
            font-family: 'Montserrat', sans-serif; 
         }
          .img-pdf img,.pdfheadersection
         {
         position: relative;
         }
         .pdfhedadingtext
         {
         padding: 0px 55px;
         }
           .main-heading-pdf
         {
         font-size: 22px;
         color: #4c4c4c;
         padding: 0px 0px 0px 35px;
         display: flex;align-items: center;line-height:0px;height:0px;
         }
          .pdfhedadingtext h1{
           
               font-size: 16.4px;
         position: absolute;
         bottom: 30%;
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
         bottom: 21%;
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
         margin-top:-7px;
         }
         .contentbodypdf > ul
         {
             padding:0px 0px 0px 137px;margin:0px;
         }
         .second-list {
    padding-left: 26px;
    padding-bottom: 8px !important;
}
         .contentbodypdf ul li
         {
              margin:0px;
               padding:0px 0px 0px 5px;
               font-size: 14px;
               color: #000000;
               position: relative;
         }
         .contentbodypdf ul li::before {
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
         .second-list > li
         {
               margin:0px;
                     padding:0px 0px 0px 5px;
                     line-height:auto;
                     height:auto;
                     font-size: 14px;
                     color: #000000;
         }
         ul li {
    list-style-type: none;
}
   
         /*body::before*/
         /*   {*/
         /*       content: "";*/
         /*       display: block;*/
         /*       top: -20px;*/
         /*       height: 297mm;*/
         /*       width: 100%;*/
         /*       background-image: url('https://course.cromacampus.com/public/pdf/body.jpg');*/
         /*       background-repeat: no-repeat;*/
         /*       background-size: cover;*/
         /*       z-index: -1;*/
         /*       position: fixed;*/

         /*   }*/
    </style>
</head>
<body>
   <div class="headerpdf">
         <div class="pdfheadersection">
            <div class="img-pdf">
               <img src="{{basepath('pdf/header.jpg')}}" alt="header" class="img">
            </div>
            <div class="pdfhedadingtext">
               <h1>Master Program</h1>
               <h2>master in mean <span><br>full stack development</span></h2>
            </div>
         </div>
      </div>
      
            <!-- pdf table body section start html  -->
      
           <div class="bodypdf">
            <h2 class="main-heading-pdf">Web Designing</h2>
            <span class="lain"></span>

        <div class="contentbodypdf">
         <span class="pdfcoursetitle" style="padding:0px;margin:0px; display: flex;align-items: center;line-height:auto;height:auto;">
            <h3 style="
               font-size: 18px;
               text-transform: uppercase;
               padding:20px 0px 5px 75px;
               margin:0px;
               font-weight:700;
               "><img style="width: 15px;margin-right:8px;" src="{{basepath('pdf/checkiconheading.png')}}" alt="checkiconheading">HTML</h3>
         </span>
         
             @foreach(range(0,100) as $value)

               <ul>
                   <li> 
                   What is HTML?
                      <ul class="second-list">
                          <li>HTML Development Environments</li>
                          <li>HTML Development Environments</li>
                      </ul>
                   </li>
                   <li>asdfasdfasdfas
                   
                   </li>
                   <li>
                       adsfasdfdasfasdf
                   
                   </li>
               </ul>
           
                @endforeach

         </div> 
      </div>
      
      <!-- pdf table body section end html  -->
      
      
            <!-- pdf table footer section start html  -->
      <div class="footerpdf">
         <img src="{{basepath('pdf/footer.jpg')}}" alt="header" class="img">
      </div>
</body>
</html>