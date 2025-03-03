@extends('layouts.headerSidebar')

@section('title')
    Newsletter
@endsection

@section('content')
    <div class="newsletter-section">
        <div class="row">
            <div class="col-8 offset-2">
                <div class="search-bar mb-3">
                    <form action="{{route('email.search')}}" method="GET">
                        <div class="input-group mt-2">
                            <input type="text" class="form-control" name="id" placeholder="Id">
                            <input type="text" class="form-control" name="email" placeholder="Email">
                            <select class="form-select" name="status">
                                <option disabled selected>Status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="rejected">Rejected</option>
                            </select>
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
                    <h5>Manage Newsletters</h5>
                </div>
            </div>
            <div class="col-4">
                <div class="text-end">
                    <a href="{{route('email.list')}}" class="btn btn-outline-info btn-sm"><i class="fa-solid fa-arrows-rotate"></i></a>
                    <a href="#" class="btn btn-success btn-sm">Send Email</a>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <div class="newsletter-body">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col" class="text-center">Id</th>
                                <th scope="col" class="text-center text-nowrap">Create Time</th>
                                <th scope="col">Email</th>
                                <th scope="col" class="text-center">Status</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($emails as $email)
                                <tr>
                                    <th scope="row" class="text-center">{{$email->id ??''}}</th>
                                    <td class="text-center">{{$email->created_at ??'N/A'}}</td>
                                    <td>{{$email->email ??'N/A'}}</td>
                                    <td class="text-center">{{$email->status ??'N/A'}}</td>
                                    <td class="text-center text-nowrap">
                                        <a href="#" class="btn btn-outline-success btn-sm">
                                            <i class="fa-regular fa-paper-plane"></i>
                                        </a>
                                        <button type="button" value="{{$email->id}}" class="btn btn-outline-warning editBtn btn-sm">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <a class="remove btn btn-outline-danger btn-sm" data-id="{{ $email->id ??''}}">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{$emails->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- EDIT MODAL CODE STATR --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Email</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{route('email.update')}}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="id">
                <div class="mb-3">
                  <label for="email" class="col-form-label">Email</label>
                  <input type="email" name="email" value="{{old('email')}}" class="form-control" id="email">
                  @error('email') <span class="text-danger">{{$message}}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="status" class="col-form-label">Status</label>
                    <input type="text" name="status" value="{{old('status')}}" class="form-control" id="status">
                    @error('status') <span class="text-danger">{{$message}}</span> @enderror
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    {{-- EDIT MODAL CODE END --}}

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
                        <h4 class="mb-1">Are you sure you want to remove this news?</h4>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="delete">Yes, Delete It!</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Modal End-->

@endsection

@push('script')
    <script>
        $(document).ready(function () {
            $(document).on('click', '.editBtn', function () {
                var email_id = $(this).val();
                // alert(email_id);
                $('#editModal').modal('show');

                $.ajax({
                    type: "GET",
                    url: "{{ route('email.edit', ':id') }}".replace(':id', email_id),
                    success: function (response) {
                        $('#id').val(email_id);
                        $('#email').val(response.email.email);
                        $('#status').val(response.email.status);
                    }
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
                        url: "{{ route('email.delete', ':id') }}".replace(':id', id),
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            _method: "DELETE" 
                        },
                        success: function (response) {
                            // toastr.success(response.success);
                            $('#removeModal').modal('hide'); // মডাল বন্ধ করা
                            location.reload(); // পেজ রিফ্রেশ করা
                        },
                        error: function (xhr) {
                            // toastr.error("Something went wrong!"); // এরর হ্যান্ডলিং
                        }
                    });
                });
            });
        });
    </script>
@endpush
