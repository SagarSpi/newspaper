
@extends('backend.layouts.headerSidebar')

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
                <div class="search-bar">
                    <form action="" method="GET">
                        <div class="input-group mt-2">
                            <input class="form-control" name="search" placeholder="Keyword">
                            <input class="form-control" name="search" placeholder="Title">
                            <input class="form-control" name="search" placeholder="Category">
                            <input class="form-control" name="search" placeholder="Status">
                            <button type="submit" class="btn btn-outline-primary" id="search-btn">Search</button>
                            <button type="button" class="btn btn-outline-danger" id="reset-btn">Reset</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-8">
                <div class="heading">
                    <h5>Manage Articles</h5>
                </div>
            </div>
            <div class="col-4">
                <div class="add-article-btn">
                    <a href="{{route('article.create')}}" class="btn btn-success btn-sm">Add Article</a>
                </div>
            </div>
        </div>
        <div class="row">
            <dib class="col-12">
                <div class="article-body">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Title</th>
                                <th scope="col">Category</th>
                                <th scope="col">Summary</th>
                                <th scope="col">Image</th>
                                <th scope="col">Status</th>
                                <th scope="col">Created by</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($article as $news)
                                <tr>
                                    <th scope="row">{{$news->id}}</th>
                                    <td>{{$news->title}}</td>
                                    <td>{{$news->category}}</td>
                                    <td>{{$news->shortDesc}}</td>
                                    <td><img src="{{$news->image_url}}" alt="News Image" height="40" width="40"></td>
                                    <td>{{$news->status}}</td>
                                    <td style="white-space: nowrap;">{{$news->user->name}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="{{route('article.show',$news->id)}}"><i class="fa-solid fa-eye pe-2"></i> View</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="{{route('article.edit',$news->id)}}"><i class="fa-solid fa-pen-to-square pe-2"></i> Edit</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item remove" data-id="{{$news->id}}"><i class="fa-solid fa-trash pe-2"></i> Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="paginate">
                        <div class="col-12">
                            {{$article->links()}}
                        </div>
                    </div>
                </div>
            </dib>
        </div>
    </div>

    <!-- Delete Modal Start-->
    <div class="modal fade" id="removeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
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
        $('.remove').on('click', function () {
            $('#removeModal').modal('show');
            let id=$(this).attr('data-id');

            $('#delete').on('click', function () {

                $.ajax({url: '/manage/remove/'+ id +'/article', success: function(result){
                    location.reload();
                }});
            })
        })
    </script>
@endpush