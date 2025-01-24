
@extends('admin.layouts.headerSidebar')

@section('title')
    News Page
@endsection

@section('content')
    <div class="new-section">
        <div class="row">
            <div class="col-8">
                <div class="heading">
                    <h1>News Page</h1>
                </div>
            </div>
            <div class="col-4">
                <div class="search-bar">
                    <form action="" method="GET">
                        <div class="input-group mt-2">
                            <input class="form-control" name="search" placeholder="Search News..." required>
                            <button type="submit" class="btn btn-outline-primary" id="search-btn">Search</button>
                            <button type="button" class="btn btn-outline-danger" id="reset-btn">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <dib class="col-12">
                <div class="news-body">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Title</th>
                                <th scope="col">Category</th>
                                <th scope="col">Summary</th>
                                <th scope="col">Image</th>
                                <th scope="col">Status</th>
                                <th scope="col" style="white-space: nowrap;" >Created by</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($newsArticle as $news)
                                <tr>
                                    <th scope="row">{{$news['id']}}</th>
                                    <td>{{$news['title']}}</td>
                                    <td>{{$news['category']}}</td>
                                    <td>{{$news['shortDesc']}}</td>
                                    <td><img src="{{$news['image_url']}}" alt="News Image" height="40" width="40"></td>
                                    <td>{{$news['status']}}</td>
                                    <td>{{$news['created_by']}}</td>
                                    <td style="white-space: nowrap;">
                                        <a href="{{route('news.show',$news['id'])}}" class="btn btn-primary btn-sm">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{route('news.edit',$news['id'])}}" class="btn btn-warning btn-sm">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <a href="{{ route('news.destroy',$news['id'])}}" class="btn btn-danger btn-sm">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="paginate">
                        <div class="col-12">
                            {{$newsArticle->links()}}
                        </div>
                    </div>
                </div>
            </dib>
        </div>
    </div>
@endsection
