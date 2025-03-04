@extends('layouts.headerSidebar')

@section('title')
    Request Article
@endsection

@section('content')
    <div class="article-request-section">
        <div class="row">
            <div class="col-8 offset-2">
                <div class="search-bar mt-3">
                    <form action="{{route('article.search')}}" method="GET">
                        <div class="input-group mt-2">
                            <input class="form-control" name="keyword" placeholder="Keyword">
                            <input type="text" class="form-control" name="title" placeholder="Title">
                            <input type="text" class="form-control" name="category" placeholder="Category">
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
            <div class="col-12">
                <div class="my-3">
                    <h5>Manage Request Articles</h5>
                </div>
            </div>
            <div class="col-12 mb-3">
                <div class="d-flex justify-content-between align-items-center">

                    @can('approved',App\Models\Backend\Article::class)
                        <a href="#" id="approvedAllSelectedRecord" class="btn btn-outline-danger btn-sm">Approved All Selected</a>
                    @else
                        <button type="button" class="btn btn-outline-danger btn-sm disabled" aria-disabled="true" >Approved All Selected</button>
                    @endcan
                    <div>
                        <a href="{{route('article.list')}}" class="btn btn-outline-info btn-sm"><i class="fa-solid fa-arrows-rotate"></i></a>
                        @can('create', App\Models\Backend\Article::class)
                            <a href="{{ route('article.create') }}" class="btn btn-success btn-sm">Add New Article</a>
                        @else
                            <button type="button" class="btn btn-success btn-sm disabled" aria-disabled="true">Add New Article</button>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="article-request-body">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col" class="text-center"><input type="checkbox" name="" id="select_all_ids"></th>
                                <th scope="col">Id</th>
                                <th scope="col" class="text-center text-nowrap">Created At</th>
                                <th scope="col">Category</th>
                                <th scope="col">Title</th>
                                <th scope="col" class="text-center">Image</th>
                                <th scope="col" class="text-center">Status</th>
                                <th scope="col" class="text-center text-nowrap">Created by</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($articles as $news)
                                <tr id="article_ids{{$news->id}}">
                                    <th><input type="checkbox" value="{{$news->id}}" name="ids" id="" class="checkbox_ids"></th>
                                    <th scope="row" >{{$news->id ??''}}</th>
                                    <td class="text-center">{{$news->created_at ??'N/A'}}</td>
                                    <td>{{$news->category ??'N/A'}}</td>
                                    <td>{{$news->title ??'N/A'}}</td>
                                    <td class="text-center"><img src="{{$news->image_url ?? ''}}" alt="News Image" height="40" width="40"></td>
                                    <td class="text-center">{{$news->status ??'N/A'}}</td>
                                    <td class="showCreator text-center text-nowrap" data-id="{{ $news->user->id ?? 'N/A' }},{{ $news->user->name ?? 'N/A' }},{{ $news->user->email ?? 'N/A' }},{{ $news->user->image_url ?? 'N/A' }},{{ $news->user->contacts ?? 'N/A' }},{{ $news->user->role ?? 'N/A' }}" >{{$news->user->name ??'N/A'}}</td>
                                    <td class="text-center text-nowrap">
                                        @can('approved',$news)
                                            <a class="approved btn btn-outline-success btn-sm" data-id="{{ $news->id ??''}}"">
                                                <i class="fa-solid fa-check"></i>
                                            </a>
                                        @else
                                            <button type="button" class="btn btn-outline-success btn-sm disabled" aria-disabled="true">
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                        @endcan
                                        @can('view',$news)
                                            <a href="{{route('article.show',$news->id ??'')}}" class="btn btn-outline-primary btn-sm">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                        @else
                                            <button type="button" class="btn btn-outline-primary btn-sm disabled" aria-disabled="true">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                        @endcan
                                        @can('update', $news)
                                            <a href="{{ route('article.edit', $news->id ??'')}}" class="btn btn-outline-warning btn-sm">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                        @else
                                            <button type="button" class="btn btn-outline-warning btn-sm disabled" aria-disabled="true">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                        @endcan
                                        @can('delete',$news)
                                            <a class="remove btn btn-outline-danger btn-sm" data-id="{{ $news->id ??''}}">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        @else
                                            <button type="button" class="btn btn-outline-danger btn-sm disabled" ria-disabled="true">
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
                        <h4 class="mb-1">Are you sure you want to approved this news?</h4>
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

    {{-- APPROVED MODAL AJAX SCRIPT --}}
    <script>
         $(document).ready(function () {
            $('.approved').on('click', function () {
                let id = $(this).data('id'); 
                $('#approvedModal').modal('show'); 

                $('#approvedBtn').off('click').on('click', function () {
                    $.ajax({
                        url: "{{ route('article.approved', ':id') }}".replace(':id', id),
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

    {{-- APPROVED ALL AJAX SCRIPT --}}
    <script>
        $(function (e) {
            $('#select_all_ids').click(function () {
                $('.checkbox_ids').prop('checked',$(this).prop('checked'));
            });

            $('#approvedAllSelectedRecord').click(function (e) {
                e.preventDefault();
                var all_ids = [];
                $('input:checkbox[name=ids]:checked').each(function () {
                    all_ids.push($(this).val());
                });
                if (all_ids.length === 0) {
                    // toastr.error("Please select at least one record to approved.");
                    return;
                };

                $.ajax({
                    url: "{{ route('article.approvedAll') }}",
                    type: "POST",
                    data: {
                        ids: all_ids,
                        _token: "{{ csrf_token() }}",
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

    {{-- DELETE MODAL AJAX SCRIPT --}}
    <script>
        $(document).ready(function () {
            $('.remove').on('click', function () {
                let id = $(this).data('id'); 
                $('#removeModal').modal('show'); 

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