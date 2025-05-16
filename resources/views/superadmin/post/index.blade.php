@extends('superadmin.layouts.app')
@section('title', 'Post')
@section('css')
@endsection
@section('content')
<div class="page-content">
   <div class="container-fluid">
      <!-- start page title -->
      <div class="row">
         <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
               <h4 class="mb-sm-0">Post</h4>
               <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                     <li class="breadcrumb-item"><a href="javascript: void(0);">INTERVIWE</a></li>
                     <li class="breadcrumb-item active">Post</li>
                  </ol>
               </div>
            </div>
         </div>
      </div>
      <!-- end page title -->
    
      <div class="row">
         <div class="col-lg-12">
            <div class="card" id="applicationList">
               <div class="card-header  border-0">
                  <div class="d-md-flex align-items-center">
                     <h5 class="card-title mb-3 mb-md-0 flex-grow-1">Post</h5>
                     <div class="flex-shrink-0">
                        <div class="d-flex gap-1 flex-wrap">
                        
                           <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ViewPostModal"><i class="ri-add-line align-bottom me-1"></i> CREATE POST</button>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="card-body border border-dashed border-end-0 border-start-0">
               <form id="filterForm">
                  <div class="row g-3">
                     <div class="col-xxl-2 col-sm-4">
                        <input type="text" class="form-control search me-2" name="query" id="query" placeholder="Search...">
                     </div>
                     <div class="col-xxl-1 col-sm-4">
                        <button type="submit" class="btn btn-primary w-100">
                           <i class="ri-equalizer-fill me-1 align-bottom"></i> Filters
                        </button>
                     </div>
                  </div>
               </form>
               </div>
               <div class="card-body pt-0">
                  <div>
                     <ul class="nav nav-tabs nav-tabs-custom nav-success mb-3" role="tablist">
                        <li class="nav-item">
                           <a class="nav-link active All py-3" data-bs-toggle="tab" id="All" href="#" role="tab" aria-selected="true">
                           POST LISTING
                           </a>
                        </li>
                     </ul>
                     <div class="table-responsive table-card mb-1">
                        <table class="table table-nowrap align-middle" id="jobListTable">
                           <thead class="text-muted table-light">
                              <tr class="text-uppercase">
                                 <th class="sort" data-sort="id" style="width: 140px;">ID</th>
                                 <th class="sort" >TITLE</th>
                                 <th class="sort" >CONTENT</th>
                                 <th class="sort" >STATUS</th>
                               
                                 <th class="sort" >ACTION</th>
                              </tr>
                           </thead>
                           <tbody class="list form-check-all">
                              @foreach ($Post as $p)
                              <meta name="csrf-token" content="{{ csrf_token() }}">
                              <tr>
                                 <td class="id"><a href="#" class="fw-medium link-primary">{{ $p->id  ?? '/' }}</a></td>
                                 <td class="id"><a href="#" class="fw-medium link-primary">{{ $p->title ?? '/' }}</a></td>
                                 <td class="id"><a href="#" class="fw-medium link-primary">{{ $p->content ?? '/' }}</a></td>
                                 <td>
                                    <input type="checkbox"
                                        class="toggle-status"
                                        data-id="{{ $p->id }}"
                                        data-toggle="toggle"
                                        data-on="Published"
                                        data-off="Draft"
                                        data-onstyle="success"
                                        data-offstyle="danger"
                                        {{ $p->status == 'published' ? 'checked' : '' }}>
                                </td>
                                 <td>
                                    <ul class="list-inline hstack gap-2 mb-0">
                                       <li class="list-inline-item" data-bs-toggle="modal" data-bs-target="" data-id="{{ $p->id }}"  data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="View">
                                          <a href="#" class="text-primary d-inline-block view-item-btn" data-id="{{ $p->id }}">
                                          <i class="ri-eye-fill fs-16"></i>
                                          </a>
                                       </li>
                                       <li class="list-inline-item"  title="Remove">
                                          <a class="text-danger d-inline-block remove-item-btn delete"  data-id="{{ $p->id }}" href="#deleteOrder">
                                          <i class="ri-delete-bin-5-fill fs-16"></i>
                                          </a>
                                       </li>
                                    </ul>
                                 </td>
                              </tr>
                              @endforeach
                              @if ($Post->isEmpty())
                              <tr>
                                 <td colspan="6" class="text-center" style="color:red;">No records found.</td>
                              </tr>
                              @endif
                           </tbody>
                        </table>
                       
                     </div>
                     <div class="d-flex justify-content-end">
                        <div class="pagination-wrap hstack gap-2">
                           @if ($Post->onFirstPage())
                           <a class="page-item pagination-prev disabled" href="javascript:void(0);">
                           Previous
                           </a>
                           @else
                           <a class="page-item pagination-prev" href="{{ $Post->previousPageUrl() }}">
                           Previous
                           </a>
                           @endif
                           <ul class="pagination listjs-pagination mb-0">
                              @php
                              $start = max(1, $Post->currentPage() - 5);
                              $end = min($Post->lastPage(), $start + 9);
                              @endphp
                              @for ($i = $start; $i <= $end; $i++)
                              <li class="{{ $i == $Post->currentPage() ? 'active' : '' }}">
                                 <a class="page" href="{{ $Post->url($i) }}" data-i="{{ $i }}" data-page="{{ $Post->perPage() }}">{{ $i }}</a>
                              </li>
                              @endfor
                           </ul>
                           @if ($Post->hasMorePages())
                           <a class="page-item pagination-next" href="{{ $Post->nextPageUrl() }}">
                           Next
                           </a>
                           @else
                           <a class="page-item pagination-next disabled" href="javascript:void(0);">
                           Next
                           </a>
                           @endif
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!--end col-->
      </div>
      <!--end row-->
   </div>
   <!-- container-fluid -->
</div>
{{-- Create Modal --}}
<div class="modal fade" id="ViewPostModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content border-0">
         <form id="postform"   method="POST" autocomplete="off" class="needs-validation"  enctype="multipart/form-data" novalidate>
            @csrf
            <div class="modal-body">
               <input type="hidden" id="id-field" />
               <div class="row g-3">
                  <div class="col-lg-12">
                     <div class="px-1 pt-1">
                        <div class="modal-team-cover position-relative mb-0 mt-n4 mx-n4 rounded-top overflow-hidden">
                           <img src="{{ asset('backend/images/small/img-9.jpg') }}" alt="" id="modal-cover-img" class="img-fluid">
                           <div class="d-flex position-absolute start-0 end-0 top-0 p-3">
                              <div class="flex-grow-1">
                                 <h5 class="modal-title text-white" id="exampleModalLabel">CREATE POST</h5>
                              </div>
                              <div class="flex-shrink-0">
                                 <div class="d-flex gap-3 align-items-center">
                                    <button type="button" class="btn-close btn-close-white"  id="close-jobListModal" data-bs-dismiss="modal" aria-label="Close"></button>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="text-center mb-4 mt-n5 pt-2">
                        <div class="position-relative d-inline-block">
                           <div class="avatar-lg p-1">
                              <div class="avatar-title bg-light rounded-circle">
                                 <img src="{{ asset('backend/images/users/multi-user.jpg')}}" id="companylogo-img" class="avatar-md rounded-circle object-fit-cover" />
                              </div>
                           </div>
                        </div>
                       
                     </div>
                     
                  </div>
                  <div class="col-lg-12">
                     <div>
                        <label for="user_name" class="form-label"> TITLE</label>
                        <input type="text" id="title" class="form-control" name="title" placeholder="Enter title"/>
                     </div>
                     
                  </div>
                  <div class="col-lg-12">
                     
                     <div>
                        <label for="user_name" class="form-label">CONTENT</label>
                        <input type="TEXT" id="content" class="form-control" name="content" placeholder="Enter  content"/>
                     </div>
                  </div>
                
                 
                
                 
             
                 
               </div>
            </div>
            <div class="modal-footer">
               <div class="hstack gap-2 justify-content-end">
                  <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-success" id="add-btn">Submit</button>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
{{-- Update Modal --}}
<div class="modal fade" id="UpdatePost" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content border-0">
         <form id="postUpdateform"   method="POST" autocomplete="off" enctype="multipart/form-data" class="needs-validation" novalidate>
            @csrf
            <meta name="csrf-token" content="{{ csrf_token() }}">
            
            <div class="modal-body">
            <input type="hidden" id="country-id" />
            <!-- <input type="hidden" id="update-id-field" name="update_id" /> -->
               <div class="row g-3">
                  <div class="col-lg-12">
                     <div class="px-1 pt-1">
                        <div class="modal-team-cover position-relative mb-0 mt-n4 mx-n4 rounded-top overflow-hidden">
                           <img src="{{ asset('backend/images/small/img-9.jpg') }}" alt="" id="modal-cover-img" class="img-fluid">
                           <div class="d-flex position-absolute start-0 end-0 top-0 p-3">
                              <div class="flex-grow-1">
                                 <h5 class="modal-title text-white" id="exampleModalLabel">EDIT POST</h5>
                              </div>
                              <div class="flex-shrink-0">
                                 <div class="d-flex gap-3 align-items-center">
                                    <button type="button" class="btn-close btn-close-white"  id="close-jobListModal" data-bs-dismiss="modal" aria-label="Close"></button>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="text-center mb-4 mt-n5 pt-2">
                        <div class="position-relative d-inline-block">
                           <div class="avatar-lg p-1">
                              <div class="avatar-title bg-light rounded-circle">
                                 <img src="{{ asset('backend/images/users/multi-user.jpg')}}" id="companylogo-img" class="avatar-md rounded-circle object-fit-cover" />
                              </div>
                           </div>
                        </div>
                        {{-- 
                        <h5 class="fs-13 mt-3">Company Logo</h5>
                        --}}
                     </div>
                     
                  </div>
                  <div class="col-lg-12">
                     <div>
                        <label for="user_name" class="form-label"> TITLE</label>
                        <input type="text" id="update_title" class="form-control" name="title" placeholder="Enter  Title"/>
                     </div>
                     
                  </div>
                  <div class="col-lg-12">
                     
                     <div>
                        <label for="user_name" class="form-label">CONTENT</label>
                        <input type="text" id="update_content" class="form-control" name="content" placeholder="Enter content"/>
                     </div>
                  </div>
               
                  
                 
               </div>
            </div>
            <div class="modal-footer">
               <div class="hstack gap-2 justify-content-end">
                  <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-success" id="add-btn">Update</button>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection
@section('js')
<style>
   .toast-success {
   background-color: #3498db;
   color: #fff;
   }
   .toast-close-button {
   color: #fff;
   }
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<script>
   $.ajaxSetup({
     headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
   });


   $(document).on('click', '.delete', function(e) {
     let id = $(this).attr('data-id');
     Swal.fire({
         title: 'Are you sure?',
         text: "It Will Permanently Deleted!",
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Yes, delete it!'
     }).then((result) => {
         if (result.isConfirmed) {
             $.ajax({
                 type: "delete",
                 url: "{{ route('superadmin.post.delete', ['_id']) }}".replace('_id', id),
                 dataType: "json",
                 success: function(response) {
                  toastr.success(response.message, 'Success');
                  setTimeout(function(){
                      window.location.href = "{{ route('superadmin.post.index') }}";
                  }, 3000);
              },
             });
         }
     })
   });
 
   $('#postform').submit(function(event) {
    event.preventDefault();
    var title = $('#title').val();
    if (!title) {
        toastr.error('Please enter your title.', 'Error');
        return;
    }
    if (title.length > 5) {
        toastr.error('Only 5 characters are allowed in title.', 'Error');
        return;
    }
    var content = $('#content').val();
    if (!content) {
        toastr.error('Please enter your content.', 'Error');
        return;
    }
    
    if (content.length > 50) {
        toastr.error('Only 50 characters are allowed in content.', 'Error');
        return;
    }
    
   
    var formAction = "{{ route('superadmin.post.store') }}"; 
    $(this).attr('action', formAction);
   
    $.ajax({
        type: $(this).attr('method'),
        url: formAction, 
        data: new FormData(this),
        contentType: false,
        processData: false,
        success: function(response) {
            toastr.success(response.message, 'Success');
            setTimeout(function() {
                window.location.href = "{{ route('superadmin.post.index') }}";
            }, 3000);
        },
        error: function(error) {
            toastr.error('Something went wrong. Please try again later.', 'Error');
        }
    });
   });
   
    
</script>
<script>
$('#postUpdateform').submit(function (e) {
    e.preventDefault();
    
     var title = $('#update_title').val();
     var content = $('#update_content').val();
     if (!title) {
        toastr.error('Please enter your title.', 'Error');
        return;
    }
    if (title.length > 5) {
        toastr.error('Only 5 characters are allowed in title.', 'Error');
        return;
    }
    if (!content) {
        toastr.error('Please enter your content.', 'Error');
        return;
    }
    if (content.length > 50) {
        toastr.error('Only 50 characters are allowed in content.', 'Error');
        return;
    }

    var contactId = $('#country-id').val();
    var url = "{{ route('superadmin.post.update', ':id') }}".replace(':id', contactId);
    var formData = new FormData(this); 
    $.ajax({
        url: url,
        type: 'POST',  
        data: formData,
        processData: false, 
        contentType: false, 
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'X-HTTP-Method-Override': 'PUT' 
        },
        success: function (response) {
            if (response.status) { 
                toastr.success(response.message, 'Success');
                setTimeout(function(){
                    location.reload();
                }, 2000);
            }
        },
        error: function (error) {
            console.log("Error:", error);
            toastr.error("Something went wrong!", "Error");
        }
    });
});
$(document).on('click', '.view-item-btn', function () {
    var contactId = $(this).data('id'); 
    var url = "{{ route('superadmin.post.edit', ':id') }}".replace(':id', contactId); 

    $.ajax({
        url: url,
        type: 'GET',
        success: function (response) {
            if (response.status) {
                $('#country-id').val(response.message.id);
                $('#update_title').val(response.message.title);
                $('#update_content').val(response.message.content);
                $('#UpdatePost').modal('show');
            }
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        }
    });
});

</script>
<script>
  $(document).ready(function () {
    $('#filterForm').on('submit', function (e) {
        e.preventDefault();
        let query = $('#query').val();
        $.ajax({
            url: "{{ route('superadmin.post.filter') }}",
            type: "GET",
            data: { query: query },
            success: function (response) {
                let tableBody = '';
                if (response.Post.length > 0) {
                    response.Post.forEach(Post => {
                        tableBody += `
                            <tr>
                                <td>${Post.id}</td>
                                <td>${Post.title ?? '/'}</td>
                                <td>${Post.content ?? '/'}</td>
                                <td>
                                    <input type="checkbox"
                                        class="toggle-status"
                                        data-id="${Post.id}"
                                        data-toggle="toggle"
                                        data-on="Published"
                                        data-off="Draft"
                                        data-onstyle="success"
                                        data-offstyle="danger"
                                        ${Post.status === 'published' ? 'checked' : ''}>
                                </td>
                                <td>
                                    <ul class="list-inline hstack gap-2 mb-0">
                                        <li class="list-inline-item" title="View">
                                            <a href="#" class="text-primary d-inline-block view-item-btn" data-id="${Post.id}">
                                                <i class="ri-eye-fill fs-16"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item" title="Remove">
                                            <a href="#deleteOrder" class="text-danger d-inline-block remove-item-btn delete" data-id="${Post.id}">
                                                <i class="ri-delete-bin-5-fill fs-16"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        `;
                    });
                } else {
                    tableBody = '<tr><td colspan="5" class="text-center text-danger">No records found.</td></tr>';
                }

                $('tbody.list').html(tableBody);
                $('input[data-toggle="toggle"]').bootstrapToggle();
            }
        });
    });
  });
</script>
<script>
    $(function () {
        $('.toggle-status').bootstrapToggle();

        $(document).on('change', '.toggle-status', function () {
            let postId = $(this).data('id');
            let status = $(this).prop('checked') ? 'published' : 'draft';

            $.ajax({
                url: '{{ route("superadmin.post.toggleStatus") }}',
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    id: postId,
                    status: status
                },
                success: function (response) {
                    toastr.success(response.message);
                },
                error: function () {
                    toastr.error('Failed to update status.');
                }
            });
        });
    });
</script>

@endsection