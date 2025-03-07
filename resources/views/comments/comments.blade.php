@extends('layouts.headerSidebar')

@section('title')
    Comment 
@endsection

@section('content')
    <div class="comment-section">
        <div class="row">
            <div class="col-8 offset-2">
                <div class="search-bar my-3">
                    <form action="{{route('comment.search')}}" method="GET">
                        <div class="input-group mt-2">
                            <input type="text" class="form-control" name="id" placeholder="Id">
                            <input type="text" class="form-control" name="title" placeholder="Title">
                            <input type="text" class="form-control" name="subject" placeholder="Subject">
                            <input type="text" class="form-control" name="article_id" placeholder="Article Id">
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
                    <h5>Manage Comments</h5>
                </div>
            </div>
            <div class="col-4">
                <div class="text-end">
                    <a href="{{route('comment.list')}}" class="btn btn-outline-info btn-sm"><i class="fa-solid fa-arrows-rotate"></i></a>
                    @can('deleteAll',App\Models\Frontend\Comment::class)
                        <a href="#" id="deleteAllSelectedRecord" class="btn btn-outline-danger btn-sm">Delete All Selected</a>
                    @else
                        <button type="button" class="btn btn-outline-danger btn-sm disabled" aria-disabled="true" >Delete All Selected</button>
                    @endcan
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <div class="comment-body">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col" class="text-center"><input type="checkbox" name="" id="select_all_ids"></th>
                                <th scope="col" class="text-center">Id</th>
                                <th scope="col" class="text-center">Create At</th>
                                <th scope="col">Title</th>
                                <th scope="col">Subject</th>
                                <th scope="col" class="text-center text-nowrap">Article Id</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($comments as $comment)
                                <tr id="comment_ids{{$comment->id}}">
                                    <td class="text-center"><input type="checkbox" value="{{$comment->id}}" name="ids" id="" class="checkbox_ids"></td>
                                    <th scope="row" class="text-center">{{$comment->id ??''}}</th>
                                    <td class="text-center">{{$comment->created_at ??'N/A'}}</td>
                                    <td>{{$comment->title ??'N/A'}}</td>
                                    <td>{{$comment->subject ??'N/A'}}</td>
                                    <td class="text-center"><a href="{{route('article.show',$comment->commentable_id)}}">{{$comment->commentable_id ??'N/A'}}</a></td>
                                    <td class="text-center text-nowrap">
                                        @can('view',$comment)
                                            <button type="button" value="{{$comment->id}}" class="btn btn-outline-primary showBtn btn-sm"><i class="fa-solid fa-eye"></i></button>
                                        @else 
                                            <button type="button" class="btn btn-outline-primary btn-sm disabled"aria-disabled="true">
                                            <i class="fa-solid fa-eye"></i>
                                            </button>
                                        @endcan
                                        @can('update',$comment)
                                            <a href="{{route('comment.edit',$comment->id)}}" class="btn btn-outline-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>  
                                        @else
                                            <button type="button" class="btn btn-outline-warning btn-sm disabled" aria-disabled="true">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                        @endcan
                                        @can('delete',$comment)
                                            <a class="remove btn btn-outline-danger btn-sm" data-id="{{ $comment->id ??'N/A'}}">
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
                    <div class="mt-4">
                        {{$comments->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>

  <!-- COMMENT SHOW Modal START  -->
  <div class="modal fade" id="showComment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">View Comment</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- COMMENT SHOW Modal END  -->

  {{-- delete modal start  --}}
  <x-modal id="removeModal" title="Delete Conformation" message="Are you sure you want to remove this comment?" btn="Yes, Delete It!" btnId="delete" />
  {{-- delete modal end  --}}

@endsection

@push('script')

    {{-- SHOW COMMENT MODAL AJAX CODE   --}}
    <script>
        $(document).ready(function () {
            $(document).on('click', '.showBtn', function () {
                var id = $(this).val();
                $('#showComment').modal('show');
                $.ajax({
                    type: "GET",
                    url: "{{ route('comment.show', ':id') }}".replace(':id', id),
                    success: function (response) {
                        // Modal Body-এর মধ্যে ডাটা যোগ করা হচ্ছে
                        $('.modal-body').html(`
                            <h5><strong>Title :</strong> ${response.comment.title}</h5>
                            <hr>
                            <h5><strong>Subject :</strong> ${response.comment.subject}</h5>
                            <hr>
                            <p><strong>Description :</strong> ${response.comment.description}</p>
                        `);
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
                        url: "{{ route('comment.delete', ':id') }}".replace(':id', id),
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
                }

                $.ajax({
                    url:"{{route('comment.deleteAll')}}",
                    type: "POST",
                    data: {
                        ids: all_ids,
                        _token: "{{ csrf_token() }}",
                        _method: "DELETE" 
                    },
                    success:function (response) {
                        // toastr.success(response.success);
                        $.each(all_ids,function (key,val) {
                            $('#comment_ids'+val).remove();
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
