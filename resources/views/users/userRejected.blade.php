@extends('layouts.headerSidebar')

@section('title')
    Rejected Users
@endsection

@section('content')
    <div class="rejected-user-section">
        <div class="row">
            <div class="col-8 offset-2">
                <div class="search-bar mt-3">
                    <form action="{{route('user.search')}}" method="GET">
                        <div class="input-group mt-2">
                            <input type="text" class="form-control" name="name" placeholder="Name">
                            <input type="text" class="form-control" name="email" placeholder="Email">
                            <input type="text" class="form-control" name="role" placeholder="Role">
                            <input type="text" class="form-control" name="contact" placeholder="Contact">
                            <select class="form-select" name="date_filter">
                                <option selected disabled>Filter By Date</option>
                                <option value="today">Today</option>
                                <option value="yesterday">Yesterday</option>
                                <option value="this_week">This Week</option>
                                <option value="last_week">Last Week</option>
                                <option value="this_month">This Month</option>
                                <option value="last_month">Last Month</option>
                                <option value="this_year">This Year</option>
                                <option value="last_year">Last Year</option>
                            </select>
                            <button type="submit" class="btn btn-outline-success" id="search-btn">Search</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-8">
                <div class="heading">
                    <h5>Manage Rejected Users</h5>
                </div>
            </div>
            <div class="col-4">
                <div class="text-end">
                    <a href="{{route('user.rejected')}}" class="btn btn-outline-info btn-sm"><i class="fa-solid fa-arrows-rotate"></i></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                      <tr>
                        <th scope="col">Id</th>
                        <th scope="col" class="text-center">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Contacts</th>
                        <th scope="col">Role</th>
                        <th scope="col" class="text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($rejectedUsers as $user)
                        <tr>
                            <th scope="row">{{$user->id}}</th>
                            <td class="text-center"><img src="{{$user->image_url ??''}}" class="rounded-circle" alt="User Image" height="40" width="40"></td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->contacts}}</td>
                            <td>{{$user->role}}</td>
                            <td class="text-center text-nowrap">
                            @can('view',$user)
                              <a class="btn btn-outline-primary btn-sm" href="{{route('user.show',$user->id)}}">
                                <i class="fa-solid fa-eye"></i>
                              </a>
                            @else
                              <button type="button" class="btn btn-outline-primary btn-sm disabled" aria-disabled="true">
                                <i class="fa-solid fa-eye"></i>
                              </button>
                            @endcan
                            @can('approved',$user)
                              <a class="approved btn btn-outline-success btn-sm" data-id="{{ $user->id ??''}}"">
                                <i class="fa-solid fa-check"></i>
                              </a>
                            @else
                              <button type="button" class="btn btn-outline-success btn-sm disabled" aria-disabled="true">
                                <i class="fa-solid fa-check"></i>
                              </button>
                            @endcan
                            @can('delete',$user)
                              <a class="remove btn btn-outline-danger btn-sm" data-id="{{ $user->id ??''}}">
                                <i class="fa-solid fa-trash"></i>
                              </a>
                            @else
                              <button type="button" class="btn btn-outline-danger btn-sm disabled" aria-disabled="true">
                                <i class="fa-solid fa-trash"></i>
                              </button>
                            @endcan
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <!-- Appreved Modal Start-->
    <div class="modal fade" id="approvedModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Approved Conformation</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-1">
                        <h4 class="mb-1">Are you sure you want to approved this user ?</h4>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="approvedBtn">Yes, Approved It!</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Appreved Modal End-->

    <!-- Delete Modal Start-->
    <div class="modal fade" id="removeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog  modal-dialog-centered">
          <div class="modal-content">
              <div class="modal-header">
                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete Conformation</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <div class="mt-1">
                      <h4 class="mb-1">Are you sure you want to delete this users ?</h4>
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" id="delete">Yes, Delete !</button>
              </div>
          </div>
      </div>
  </div>
  <!-- Delete Modal End-->

@endsection

@push('script')
{{-- APPROVED MODAL AJAX SCRIPT --}}
<script>
  $(document).ready(function () {
    $('.approved').on('click', function () {
      let id = $(this).data('id'); 
      $('#approvedModal').modal('show'); 

      $('#approvedBtn').off('click').on('click', function () {
        $.ajax({
            url: "{{ route('user.approved', ':id') }}".replace(':id', id),
            type: "get",
            data: {
                
            },
            success: function (response) {
                // toastr.success(response.success);
                $('#approvedModal').modal('hide'); 
                location.reload(); 
            },
            error: function (xhr) {
                // toastr.error("Something went wrong!"); 
            }
        });
      });
    });
  });
</script>
{{-- DELETE MODAL AJAX SCRIPT --}}
<script>
  $(document).ready(function () {
      $('.remove').on('click', function () {
          let id = $(this).data('id'); // ডিলিট করার আইডি বের করা
          $('#removeModal').modal('show'); // মডাল দেখানো

          // আগের ক্লিক ইভেন্ট রিসেট করে নতুন ইভেন্ট যুক্ত করা
          $('#delete').off('click').on('click', function () {
              $.ajax({
                  url: "{{ route('user.delete', ':id') }}".replace(':id', id),
                  type: "POST",
                  data: {
                      _token: "{{ csrf_token() }}",
                      _method: "DELETE" 
                  },
                  success: function (response) {
                      $('#removeModal').modal('hide'); // মডাল বন্ধ করা
                      location.reload(); // পেজ রিফ্রেশ করা
                  },
                  error: function (xhr) {
                      // Log the error to the Laravel log file
                      console.log('Error occurred:', xhr.responseText);
                  }
              });
          });
      });
  });
</script>
@endpush