@extends('layout.app')
@section('main')

<div class="tab-content1" id="pills-tabContent" >
   <div class="tab-pane fade show active" id="pills-rankview" role="tabpanel" aria-labelledby="pills-rankview-tab">
   
    <div class="container">
        <div class="tab-list-flex">
            <form method="post" action="{{Route('header.save')}}" enctype="multipart/form-data">
                @csrf
           <div class="tabbox-css">
              <div class="">
                 <div class="add-course padding-20">
                    <h3>Add Header</h3>
                    <hr>
                    <input type="hidden" name="getid" id="getid">
                    <div class="grid-two">
                        <div class="form-group">
                            <h4>Header Name</h4>
                            <input type="text" name="name" id="getname" class="my-from-control" placeholder="Enter Header Name">
                        </div>
                        <div class="form-group">
                            <h4>Upload Header</h4>
                            <div class="d-flex gap-2">
                              <div class="imageWrapper">
                                 <img class="image" src="{{basepath('images/iconprofile.svg')}}" alt="iconprofile">
                               </div>
                               
                               <button class="file-upload">            
                                 <input type="file" class="file-input" name="header_pic[]" multiple accept="image/png, image/gif, image/jpeg" />Browse File
                               </button>
                            </div>
                            <span style="font-size: 12px;opacity: 0.7;">Must be .jpg</span>                          

                        </div>
                    </div>
                 
                 </div>
                 <hr>
                 <div class="padding-10">
                    <input type="submit" class="btn btn-second me-2" value="Submit">
                    <button type="submit" class="btn btn-gray">Reset</button>
                 </div>
              </div>
           </div>
           </form>
           <div class="tabbox-css">
              <div class="course-listing listingdata padding-20">
                 <h3>Header List</h3>
                 <hr>
                 <div class="tab-content" id="pills-tabContent" style="padding: 0px;">
                    <div class="tab-pane fade show active" id="pills-rankview" role="tabpanel" aria-labelledby="pills-rankview-tab">
                       <table id="headerlist" class="display dataTable tabledesignmain addheadfootbox" style="width:100%;height: 150px;padding: 0px; overflow: auto;">
                          <thead>
                             <tr class="first">
                                <th><span>#</span></th>
                                <th><span>Header List</span></th>
                                <th><span>File</span></th>
                                <th><span>Status</span></th>
                                <th><span>Action</span></th>
                             </tr>
                          </thead>
                          <tbody>
                              @foreach($data as $key => $value)
                             <tr>
                                <td><span>{{$key+1}}</span></td>
                                <td><span title='Pipe Designing'>{{$value->name}}</span></td>
                                <td>
                                    @php 
                                    $header_pic=explode(",",$value->header_pic);
                                    $header_pic=$header_pic[0];
                                    @endphp
                                    <ul>
                                        <!--{{basepath('header/'.$header_pic)}}-->
                                        <li><a href="headerimage/{{$value->id}}" data-id="{{$value->id}}" class="imageheader" target="_blank"><img src="{{basepath('images/pdficon.svg')}}" alt="editicon"></a></li>
                                    </ul>
                                </td>

                                <td>
                                    @if($value->status==0)
                                    <span class="bg-yellow badges changestatus" data-id='{{$value->id}}' data-table='headers' data-vaalue='0' style="cursor: pointer;">Deactive</span>
                                    @else
                                    <span class="bg-green badges changestatus" data-id='{{$value->id}}' data-table='headers' data-vaalue='1' style="cursor: pointer;">Active</span>
                                    @endif
                                </td>
                                <td>
                                   <ul>
                                      <li><span  class="header_edit" data-name="{{$value->name}}" data-id="{{$value->id}}"><img src="{{basepath('images/editicon.svg')}}" alt="editicon"></span></li>
                                      <li><a href="" class="delete" data-id='{{$value->id}}' data-table='headers'><img src="{{basepath('images/deleteicon.svg')}}" alt="deleteicon"></a></li>
                                   </ul>
                                </td>
                             </tr>
                             @endforeach
                             <!--<tr>
                                <td><span>02</span></td>
                                <td><span title='Pipe Designing'>Professional Program</span></td>
                                <td><ul><li><a href="#"><img src="images/pdficon.svg" alt="editicon"></a></li></ul></td>

                                <td><span class="bg-green badges" style="cursor: pointer;">Active</span></td>
                                <td>
                                   <ul>
                                      <li><a href="#"><img src="images/editicon.svg" alt="editicon"></a></li>
                                      <li><a href="#"><img src="images/deleteicon.svg" alt="deleteicon"></a></li>
                                   </ul>
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
    

   </div>
</div>

  
  
  
 
  
  
      
@include('layout.footer')
@endsection

@section('script')
<script>
   $('.file-input').change(function(){
    var curElement = $('.image');
    console.log(curElement);
    var reader = new FileReader();

    reader.onload = function (e) {
        // get loaded data and render thumbnail.
        curElement.attr('src', e.target.result);
    };

    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
});

$('.file-input2').change(function(){
    var curElement = $('.imagesecond');
    console.log(curElement);
    var reader = new FileReader();

    reader.onload = function (e) {
        // get loaded data and render thumbnail.
        curElement.attr('src', e.target.result);
    };

    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
});
</script>
<script>
   $(document).on("click",".dedit",function(){
      var id=$(this).attr('data-id');
      var name=$(this).attr('data-name');
      $("#getid").attr("value",id);
      $("#getname").attr("value",name);
   });
</script>

<script>
   $(document).on("click",".header_edit",function(){
      var id=$(this).attr('data-id');
      var name=$(this).attr('data-name');
      $("#getid").attr("value",id);
      $("#getname").attr("value",name);
   });
</script>


<!-- common js here all   -->



@endsection