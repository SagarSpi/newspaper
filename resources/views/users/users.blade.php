@extends('layouts.headerSidebar')

@section('title')
    Users List
@endsection

@section('content')
    <div class="user-list-section">
        <div class="row">
            <div class="col-8 offset-2">
                <div class="search-bar mt-3">
                    <form action="{{route('user.search')}}" method="GET">
                        <div class="input-group mt-2">
                            <input type="text" class="form-control" name="name" placeholder="Name">
                            <input type="text" class="form-control" name="email" placeholder="Email">
                            <input type="text" class="form-control" name="role" placeholder="Role">
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
                    <h5>Manage Users</h5>
                </div>
            </div>
            <div class="col-4">
                <div class="text-end">
                    <a href="{{route('user.list')}}" class="btn btn-outline-info btn-sm"><i class="fa-solid fa-arrows-rotate"></i></a>
                    <a href="{{route('user.create')}}" class="btn btn-success btn-sm">Add New User</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mt-2">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" class="text-center">Id</th>
                            <th scope="col" class="text-center">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Contacts</th>
                            <th scope="col" class="text-center">Role</th>
                            <th scope="col" class="text-center">Status</th>
                            <th scope="col" class="text-center text-nowrap">Last Seen</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <th scope="row" class="text-center">{{$user->id ??''}}</th>
                                <td><img src="{{$user->image_url ??''}}" class="rounded-circle" alt="User Image" height="40" width="40"></td>
                                <td>{{$user->name ??'N/A'}}</td>
                                <td>{{$user->email ??'N/A'}}</td>
                                <td>{{$user->contacts ??'N/A'}}</td>
                                <td class="text-center">{{$user->role ??'N/A'}}</td>
                                <td class="text-center">
                                    <span class="bg-{{ $user->status === 'Active' ? 'success' : ($user->status === 'Inactive' ? 'info' : 'danger') }} py-1 px-3 rounded-pill text-lg text-white">
                                        {{ $user->status ?? 'N/A' }}
                                    </span>
                                </td>
                                <td class="text-center text-nowrap">{{ $user->last_seen ? $user->last_seen->diffForHumans() : 'N/A' }}</td>
                                <td class="text-center text-nowrap">
                                    <a class="btn btn-outline-primary btn-sm" href="{{route('user.show',$user->id)}}">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a class="btn btn-outline-warning btn-sm" href="{{route('user.edit',$user->id)}}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a class="remove btn btn-outline-danger btn-sm" data-id="{{ $user->id ??''}}">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="paginate">
                    <div class="col-12">
                        {{$users->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>

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
    {{-- DELETE MODAL AJAX SCRIPT --}}
    <script>
        $(document).ready(function () {
            $('.remove').on('click', function () {
                let id = $(this).data('id'); 
                $('#removeModal').modal('show'); 

                $('#delete').off('click').on('click', function () {
                    $.ajax({
                        url: "{{ route('user.delete', ':id') }}".replace(':id', id),
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            _method: "DELETE" 
                        },
                        success: function (response) {
                            // toastr.success(response.success);
                            $('#removeModal').modal('hide'); 
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
@endpush