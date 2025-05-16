@extends('superadmin.layouts.app')
@section('title', 'Dashboard')
@section('css')
@endsection
@section('content')
<div class="page-content">
   <div class="container-fluid">
      <div class="row">
         <div class="col">
            <div class="h-100">
               <div class="row mb-3 pb-1">
                  <div class="col-12">
                     <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                        <div class="flex-grow-1">
                           <h4 class="fs-16 mb-1">Good Morning, {{ __(Auth::guard('superadmin')->user()->name) }} !</h4>
                           <p class="text-muted mb-0">Here's what's happening with your store today.</p>
                        </div>
                        <div class="mt-3 mt-lg-0">
                           <form action="javascript:void(0);">
                              <div class="row g-3 mb-0 align-items-center">
                                 <div class="col-sm-auto">
                                    <div class="input-group">
                                       <input type="text" class="form-control border-0 dash-filter-picker shadow" data-provider="flatpickr" data-range-date="true" data-date-format="d M, Y" data-deafult-date="01 Jan 2022 to 31 Jan 2022">
                                       <div class="input-group-text bg-primary border-primary text-white">
                                          <i class="ri-calendar-2-line"></i>
                                       </div>
                                    </div>
                                 </div>
                                 <!--end col-->
                                 <div class="col-auto">
                                    {{-- <button type="button" class="btn btn-soft-success"><i class="ri-add-circle-line align-middle me-1"></i> Add Product</button> --}}
                                 </div>
                                 <!--end col-->
                                 <div class="col-auto">
                                    <button type="button" class="btn btn-soft-info btn-icon waves-effect waves-light layout-rightside-btn"><i class="ri-pulse-line"></i></button>
                                 </div>
                                 <!--end col-->
                              </div>
                              <!--end row-->
                           </form>
                        </div>
                     </div>
                     <!-- end card header -->
                  </div>
                  <!--end col-->
               </div>
            </div>
            <!-- end .h-100-->
         </div>
      </div>
      <!--  -->
      <div class="row">
        
         <div class="col-lg-12">
            <div>
               <div id="teamlist">
                  <div class="team-list grid-view-filter row" id="team-member-list">
                     @foreach($Post as $p)
                     <div class="col">
                        <div class="card team-box">
                           <div class="team-cover">                   
                               <img src="{{ asset('backend/images/small/img-9.jpg') }}" alt="" class="img-fluid">                </div>
                           <div class="card-body p-4">
                              <div class="row align-items-center team-row">
                                 <div class="col team-settings">
                                    <div class="row">
                                       <div class="col">
                                          <div class="flex-shrink-0 me-2">                                        <button type="button" class="btn btn-light btn-icon rounded-circle btn-sm favourite-btn ">                                            <i class="ri-star-fill fs-14"></i>                                        </button>                                    </div>
                                       </div>
                                       <div class="col text-end dropdown">
                                          <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">                                        <i class="ri-more-fill fs-17"></i>                                    </a>                                    
                                         
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-lg-4 col">
                                    <div class="team-profile-img">
                                       <div class="avatar-lg img-thumbnail rounded-circle flex-shrink-0"><img src="backend/images/users/avatar-2.jpg" alt="" class="member-img img-fluid d-block rounded-circle"></div>
                                       <div class="team-content">
                                          <a class="member-name" data-bs-toggle="offcanvas" href="#member-overview" aria-controls="member-overview">
                                             <h5 class="fs-16 mb-1">{{ $p->title ?? ''}}</h5>
                                          </a>
                                          <p class="text-muted member-designation mb-0">{{ \Illuminate\Support\Str::limit($p->content, 10) }}</p>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-lg-4 col">
                                    <div class="row text-muted text-center">
                                       <div class="col-6 border-end border-end-dashed">
                                        
                                          <p class="text-muted mb-0"></p>
                                       </div>
                                       <div class="col-6">
                                         
                                          <p class="text-muted mb-0"></p>
                                       </div>
                                    </div>
                                 </div>
                                 
                              </div>
                           </div>
                        </div>
                     </div>
                      @endforeach
                    
                  </div>
                  <div class="text-center mb-3">
                     <a href="javascript:void(0);" class="text-success"><i class="mdi mdi-loading mdi-spin fs-20 align-middle me-2"></i> Load More </a>
                  </div>
               </div>
              
             
            </div>
         </div>
        
         <!-- end col -->
      </div>
      <!--  -->
      {{--  --}}
   </div>
   <!-- container-fluid -->
</div>
{{-- <script src="{{ asset('superadmin/libs/feather-icons/feather.min.js')}}"></script>
<script src="{{ asset('superadmin/libs/node-waves/waves.min.js')}}"></script> --}}
@endsection
@section('js')
<script src="{{ asset('superadmin/js/pages/plugins/lord-icon-2.1.0.js')}}"></script>
@endsection