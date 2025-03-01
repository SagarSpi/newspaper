
@extends('layouts.headerSidebar')

@section('title')
    Article Page
@endsection

@push('css')
    <link rel="stylesheet" href="{{asset('assets/backend/css/article.css')}}">
@endpush

@section('content')
    <div class="article-section">
        <div class="row">
            <div class="col-8 offset-2">
                <div class="search-bar mt-3">
                    <form action="{{route('article.search')}}" method="GET">
                        <div class="input-group mt-2">
                            <input class="form-control" name="keyword" placeholder="Keyword">
                            <input type="text" class="form-control" name="title" placeholder="Title">
                            <input type="text" class="form-control" name="category" placeholder="Category">
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
                    <h5>Manage Articles</h5>
                    <a href="#" id="deleteAllSelectedRecord" class="btn btn-outline-danger btn-sm">Delete All Selected</a>
                </div>
            </div>
            <div class="col-4">
                <div class="text-end">
                    <a href="{{route('article.list')}}" class="btn btn-outline-info btn-sm"><i class="fa-solid fa-arrows-rotate"></i></a>
                    <a href="{{route('article.create')}}" class="btn btn-success btn-sm">Add New Article</a>
                </div>
            </div>
        </div>
        <div class="row">
            <dib class="col-12">
                <div class="article-body">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col" class="text-center"><input type="checkbox" name="" id="select_all_ids"></th>
                                <th scope="col" class="text-center">Id</th>
                                <th scope="col" class="text-center text-nowrap">Created At</th>
                                <th scope="col">Title</th>
                                <th scope="col">Category</th>
                                <th scope="col" class="text-center">Image</th>
                                <th scope="col" class="text-center">Commnets</th>
                                <th scope="col" class="text-center">Status</th>
                                <th scope="col" class="text-center text-nowrap">Created by</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($articles as $news)
                                <tr id="article_ids{{$news->id}}">
                                    <th class="text-center"><input type="checkbox" value="{{$news->id}}" name="ids" id="" class="checkbox_ids"></th>
                                    <th scope="row" class="text-center">{{$news->id ??''}}</th>
                                    <td class="text-center">{{$news->created_at ??'N/A'}}</td>
                                    <td>{{$news->title ??'N/A'}}</td>
                                    <td>{{$news->category ??'N/A'}}</td>
                                    <td class="text-center"><img src="{{$news->image_url ?? ''}}" alt="News Image" height="40" width="40"></td>
                                    <td class="text-center">{{$news->comments_count ?? 'N/A'}}</td>
                                    <td class="text-center">{{$news->status ??'N/A'}}</td>
                                    <td class="showCreator text-center text-nowrap" data-id="{{ $news->user->id ?? 'N/A' }},{{ $news->user->name ?? 'N/A' }},{{ $news->user->email ?? 'N/A' }},{{ $news->user->image_url ?? 'N/A' }},{{ $news->user->contacts ?? 'N/A' }},{{ $news->user->role ?? 'N/A' }}" >{{$news->user->name ??'N/A'}}</td>
                                    <td class="text-center text-nowrap">
                                        <a href="{{route('article.show',$news->id ??'N/A')}}" class="btn btn-outline-primary btn-sm">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        @can('update', $news)
                                            <a href="{{ route('article.edit', $news->id ??'N/A')}}" class="btn btn-outline-warning btn-sm">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <a class="remove btn btn-outline-danger btn-sm" data-id="{{ $news->id ??'N/A'}}">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        @else
                                            <a class="btn btn-outline-warning btn-sm disabled" role="button" aria-disabled="true">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <a class="btn btn-outline-danger btn-sm disabled">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- USER OFFCANVAS SIDEBAR CODE START  --}}
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasRightLabel">Creator Information</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <div class="creator-img">
                                <img id="userImage" src="" class="img-thumbnail" alt="Creator Image">
                            </div>
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <th rowspan="1">Id</th>
                                        <td><b>:</b> <span id="userId">N/A</span></td>
                                    </tr>
                                    <tr>
                                        <th rowspan="1">Name</th>
                                        <td><b>:</b> <span id="userName">N/A</span></td>
                                    </tr>
                                    <tr>
                                        <th rowspan="1">Email</th>
                                        <td><b>:</b> <span id="userEmail">N/A</span></td>
                                    </tr>
                                    <tr>
                                        <th rowspan="1">Contact</th>
                                        <td><b>:</b> <span id="userContact">N/A</span></td>
                                    </tr>
                                    <tr>
                                        <th rowspan="1">Role</th>
                                        <td><b>:</b> <span id="userRole">N/A</span></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="creator-action">
                                <a href="#" id="viewMoreBtn" class="btn btn-success btn-sm">View More</a>
                            </div>
                        </div>
                    </div>
                    {{-- USER OFFCANVAS SIDEBAR CODE END  --}}
                    <div class="paginate">
                        <div class="col-12">
                            {{$articles->links()}}
                        </div>
                    </div>
                </div>
            </dib>
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

    <script>
        $(document).ready(function () {
            $('.showCreator').on('click', function () {
                // data-id থেকে মান নিয়ে আসা
                var dataId = $(this).data('id');
                
                // কমা দিয়ে আলাদা করা
                var dataParts = dataId.split(',');

                // প্রতিটি ভ্যারিয়েবল আলাদা করা
                var userId = dataParts[0];
                var userName = dataParts[1];
                var userEmail = dataParts[2];
                var userImage = dataParts[3];
                var userContact = dataParts[4];
                var userRole = dataParts[5];

                // টেবিলের ভেতরে ডেটা আপডেট করা
                $('#userId').text(userId);
                $('#userName').text(userName);
                $('#userEmail').text(userEmail);
                $('#userImage').attr('src', userImage); // ইমেজ src আপডেট
                $('#userContact').text(userContact);
                $('#userRole').text(userRole);

                 // `View More` বাটনে ডাইনামিক URL সেট করা
                var viewMoreUrl = "{{ route('user.show', ['id' => 'userId']) }}";
                viewMoreUrl = viewMoreUrl.replace('userId', userId); // `userId` প্যারামিটার দিয়ে রাউটটি আপডেট করা

                // href অ্যাট্রিবিউটে URL সেট করা
                $('#viewMoreBtn').attr('href', viewMoreUrl);

                // Bootstrap Offcanvas ইন্সট্যান্স ওপেন করা
                var offcanvasElement = document.getElementById('offcanvasRight');
                var offcanvas = new bootstrap.Offcanvas(offcanvasElement);
                offcanvas.show();

                // "View More" বাটনে ক্লিক করলে URL এ রিডিরেক্ট করতে
                $('#viewMoreBtn').on('click', function() {
                    var url = $(this).attr('href');
                    if (url) {
                        window.location.href = url;  // রিডিরেক্ট করা
                    }
                });
            });
        });
    </script>


    {{-- <script>
        $(document).ready(function () {
            $('.showCreator').on('click', function () {
                var userId = $(this).data('id');
                console.log("User ID: " + userId); // Debugging জন্য
                
                // Bootstrap Offcanvas ইন্সট্যান্স ওপেন করা
                var offcanvasElement = document.getElementById('offcanvasRight');
                var offcanvas = new bootstrap.Offcanvas(offcanvasElement);
                offcanvas.show();
            });
        });
    </script> --}}


    {{-- DELETE MODAL AJAX SCRIPT --}}
    <script>
        $(document).ready(function () {
            $('.remove').on('click', function () {
                let id = $(this).data('id'); // ডিলিট করার আইডি বের করা
                $('#removeModal').modal('show'); // মডাল দেখানো

                // আগের ক্লিক ইভেন্ট রিসেট করে নতুন ইভেন্ট যুক্ত করা
                $('#delete').off('click').on('click', function () {
                    $.ajax({
                        url: "{{ route('article.delete', ':id') }}".replace(':id', id),
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


    {{-- DELETE ALL AJAX SCRIPT --}}
    <script>
        $(function (e) {
            $('#select_all_ids').click(function () {
                $('.checkbox_ids').prop('checked',$(this).prop('checked'));
            });

            $('#deleteAllSelectedRecord').click(function (e) {
                e.preventDefault();
                var all_ids = [];
                $('input:checkbox[name=ids]:checked').each(function () {
                    all_ids.push($(this).val());
                });
                if (all_ids.length === 0) {
                    // toastr.error("Please select at least one record to delete.");
                    return;
                };

                $.ajax({
                    url: "{{ route('article.deleteAll') }}",
                    type: "POST",
                    data: {
                        ids: all_ids,
                        _token: "{{ csrf_token() }}",
                        _method: "DELETE" 
                    },
                    success:function (response) {
                        // toastr.success(response.success);
                        $.each(all_ids,function (key,val) {
                            $('#article_ids'+val).remove();
                        })
                    },
                    error: function (xhr) {
                        // toastr.error("Something went wrong!"); // এরর হ্যান্ডলিং
                    }
                });
            });
        });
    </script>
@endpush