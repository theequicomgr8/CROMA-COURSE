@extends('layout.app')
@section('main')

<div class="tab-content" id="pills-tabContent" >
   <div class="tab-pane fade show active" id="pills-rankview" role="tabpanel" aria-labelledby="pills-rankview-tab">
   
    <div class="container">
        <div class="tab-list-flex">
           <div class="tabbox-css">
              <form method="post" action="{{Route('save.designation')}}">
               @csrf
              <div class="">
                 <div class="add-course padding-20">
                    <h3>Add Designation</h3>
                    <hr>
                    <h4>Designation</h4>
                    <input type="hidden" name="id" id="getid">
                    <input type="text" name="name" id="getname" required class="my-from-control" placeholder="Enter Designation Here">
                 </div>
                 <hr>
                 <div class="padding-10">
                    <input type="submit" class="btn btn-second me-2" value="Submit">
                    <button type="submit" class="btn btn-gray">Reset</button>
                 </div>
              </div>
               </form>
           </div>
           <div class="tabbox-css ">
              <div class="course-listing padding-20">
                 <h3>Designation List</h3>
                 <hr>
                 <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-rankview" role="tabpanel" aria-labelledby="pills-rankview-tab">
                       <table id="addcourselist" class="display addcourselist dataTable tabledesignmain" style="width:100%;height: 150px;padding: 0px; overflow: auto;">
                          <thead>
                             <tr class="first">
                                <th><span>#</span></th>
                                <th><span>Course</span></th>
                                <th><span>Status</span></th>
                                <th><span>Action</span></th>
                             </tr>
                          </thead>
                          <tbody>
                             @foreach($data as $key => $value)
                             <tr>
                                <td><span>{{$key+1}}</span></td>
                                <td><span title='Pipe Designing'>{{$value->name}}</span></td>
                                
                                 @if($value->status=='1')
                                 <td><span class="bg-green badges changestatus" data-id='{{$value->id}}' data-table='desiginations' data-vaalue='1' style="cursor: pointer;">Active</span></td>
                                 @else
                                 <td><span class="bg-yellow badges changestatus" data-id='{{$value->id}}' data-table='desiginations' data-vaalue='0' style="cursor: pointer;">Deactive</span></td>
                                 @endif
                                
                                <td>
                                   <ul>
                                      <li><span class="dedit" data-id='{{$value->id}}' data-name='{{$value->name}}' ><img src="{{basepath('images/editicon.svg')}}" alt="editicon"></span></li>
                                      <li><a class="delete" data-id='{{$value->id}}' data-table='desiginations'><img src="{{basepath('images/deleteicon.svg')}}" alt="deleteicon"></a></li>
                                   </ul>
                                </td>
                             </tr>
                             @endforeach
                             <!--<tr>
                                <td><span>02</span></td>
                                <td><span title='Pipe Designing'>Pipe Designing </span></td>
                                <td><span class="bg-yellow badges" style="cursor: pointer;">Deactive</span></td>
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
   $(".chosen-select").chosen({
     no_results_text: "Oops, nothing found!" 
   })
</script>

<script>
   $(document).on("click",".dedit",function(){
      var id=$(this).attr('data-id');
      var name=$(this).attr('data-name');
      $("#getid").attr("value",id);
      $("#getname").attr("value",name);
   });
</script>




<!-- common js here all   -->



@endsection