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
                    <a href="#" id="deleteAllSelectedRecord" class="btn btn-outline-danger btn-sm">Delete All Selected</a>
                </div>
            </div>
            <div class="col-4">
                <div class="text-end">
                    <a href="{{route('comment.list')}}" class="btn btn-outline-info btn-sm"><i class="fa-solid fa-arrows-rotate"></i></a>
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
                                        <a href="#" class="btn btn-outline-primary btn-sm"><i class="fa-solid fa-eye"></i></a>
                                        <a href="{{route('comment.edit',$comment->id)}}" class="btn btn-outline-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <a href="#" class="btn btn-outline-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
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
@endsection

@push('script')
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
                    toastr.error("Please select at least one record to delete.");
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
                        toastr.success(response.success);
                        $.each(all_ids,function (key,val) {
                            $('#comment_ids'+val).remove();
                        })
                    },
                    error: function (xhr) {
                        toastr.error("Something went wrong!"); // এরর হ্যান্ডলিং
                    }
                });
            });
        });
    </script>
@endpush
