@extends('backend.layouts.headerSidebar')

@section('title')
    Comment 
@endsection

@section('content')
    <div class="comment-section">
        <div class="row">
            <div class="col-8 offset-2">
                <div class="search-bar mb-3">
                    <form action="" method="GET">
                        <div class="input-group mt-2">
                            <input class="form-control" name="search" placeholder="Id">
                            <input class="form-control" name="search" placeholder="Title">
                            <input class="form-control" name="search" placeholder="Subject">
                            <input class="form-control" name="search" placeholder="Keyword">
                            <button type="submit" class="btn btn-outline-success" id="search-btn">Search</button>
                            <button type="button" class="btn btn-outline-danger" id="reset-btn">Reset</button>
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
                    <a href="" class="btn btn-success btn-sm">Comment</a>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <div class="comment-body">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Title</th>
                                <th scope="col">Subject</th>
                                <th scope="col" style="white-space: nowrap">Post Id</th>
                                <th scope="col" style="white-space: nowrap">User Id</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($comments as $comment)
                                <tr>
                                    <th scope="row">{{$comment->id ??''}}</th>
                                    <td>{{$comment->title ??'N/A'}}</td>
                                    <td>{{$comment->subject ??'N/A'}}</td>
                                    <td><a href="{{route('article.show',$comment->commentable_id)}}">{{$comment->commentable_id ??'N/A'}}</a></td>
                                    <td><a href="{{route('user.show',$comment->user_id)}}">{{$comment->user_id ??'N/A'}}</a></td>
                                    <td style="white-space: nowrap;">
                                        <a class="text-primary" href="">
                                            <i class="fa-solid fa-eye pe-2"></i>
                                        </a>
                                        <a class="text-success" href="">
                                            <i class="fa-solid fa-pen-to-square pe-2"></i>
                                        </a>
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