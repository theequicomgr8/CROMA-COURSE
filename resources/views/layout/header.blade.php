      <!-- header first area start  -->
      <header class="topheader bg-blue">
         <div class="container">
            <div class="row d-flex align-items-center">
               <div class="col-lg-8 col-6">
                  <ul class="nav nav-pills logo-here align-items-center" id="pills-tab" role="tablist">
                     <a href="/curriculm-list"><img src="{{basepath('images/logocroma.svg')}}" alt="logocroma" class="img-fluid me-5"></a>
                     <h2 class="mb-0">Course Curriculum</h2>
                  </ul>
               </div>
               <div class="col-lg-4 col-6">
                  <div class="urser-details">
                     <div class="dropdown img-user d-flex justify-content-end align-items-center">
                        <h2 class="mb-0 dropdown-toggle" type="button" id="dropdownMenuButton4" data-bs-toggle="dropdown" aria-expanded="false">
                           <img src="{{basepath('images/user-logo.svg')}}" alt="user">Devendra
                        </h2>
                        <ul class="dropdown-menu p-0" aria-labelledby="dropdownMenuButton4">
                           <li><a class="dropdown-item " href="#">Devendra (Admin)<img src="{{basepath('images/Edit_fill.svg')}}" alt="Edit_fill"></a> </li>
                           <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#changepassword">Change Password</a></li>
                           <li><a class="dropdown-item" href="{{Route('user.list')}}">Add User</a></li>
                           <li><a class="dropdown-item" href="{{Route('designation')}}">Add Designation</a></li>
                           <li><a class="dropdown-item" href="{{Route('add.header')}}">Add Header</a></li>
                           <li><a class="dropdown-item" href="{{Route('add.footer')}}">Add Footer</a></li> 

                           <li>
                              <hr class="dropdown-divider">
                           </li>
                           <li><a class="dropdown-item" href="{{Route('logout')}}"><i class="fa-solid fa-arrow-left-from-arc"></i> Logout</a></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </header>
      <!-- header first area end  -->
      <!-- header second area start  -->
      @php
      $totcourse=App\Models\Course::groupBy('course_name')->get();
      
      $avcourse=App\Models\Template::count();
      $manavcourse=App\Models\Manualpdf::count();
      $totalavlablecourse=$avcourse+$manavcourse;
      
      $pending=count($totcourse)-$totalavlablecourse ?? '0';
      @endphp
      <section class="second-header">
         <div class="container">
            <div class="row">
               <div class="curriculum-record">
                  <div class="coruses-cricullumlist">
                     <div class="box-cr">
                        <h2>{{count($totcourse) ?? '0'}}</h2>
                        <h4>Coruses</h4>
                     </div>
                  </div>
                  <div class="coruses-cricullumlist">
                     <div class="box-cr">
                        <h2 class="green">{{$totalavlablecourse ?? '0'}}</h2>
                        <h4>Available
                           Curriculum
                        </h4>
                     </div>
                  </div>
                  <div class="coruses-cricullumlist">
                     <div class="box-cr">
                        <h2 class="red">{{$pending}}</h2>
                        <h4>Pending Curriculum</h4>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         </div>
      </section>
      <!-- header second area end  -->