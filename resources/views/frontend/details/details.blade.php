@extends('layouts.headerFooter')

@section('title')
    Details
@endsection

@push('css')
    <link rel="stylesheet" href="{{asset('assets/frontend/css/details.css')}}">
@endpush

@section('content')
    <div class="details-section">
        <div class="row">
            <div class="col-9">
                <div class="datails-body">
                    <div class="details-topbar">
                        <div class="publish-time">
                            <p>Date : {{$news_details->created_at??'N/A'}}</p>
                            <p>1 hour ago</p>
                        </div>
                        <div class="details-share">
                            <ul>
                                <li>
                                  <a href=""><i class="fa-brands fa-facebook-f"></i></a>
                                </li>
                                <li>
                                  <a href=""><i class="fa-brands fa-whatsapp"></i></a>
                                </li>
                                <li>
                                  <a href=""><i class="fa-solid fa-link"></i></a>
                                </li>
                                <li>
                                  <a href=""><i class="fa-solid fa-share"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="details-img">
                        <img src="{{$news_details->image_url??''}}" alt="Details Image">
                    </div>
                    <div class="details-cat my-3">
                        <h5 class="text-primary"><u>{{$news_details->category??'No category available.'}}</u></h5>
                    </div>
                    <div class="deatils-title">
                        <h3>{{$news_details->title??'No title available.'}}</h3>
                    </div>
                    <div class="details-desc">
                        <p>{!!$news_details->description??'No description available'!!}</p>
                    </div>
                </div>
                <div class="comments-section">
                    <div class="row">
                        <div class="col-10 offset-1">
                            <div class="comment-body">
                                <h4 class="mb-4">Leave a Reply</h4>
                                <form action="{{route('news.comment',$news_details->id)}}" method="POST">
                                    @csrf
                                    <div class="mb-2">
                                        <label class="form-label">Title :</label>
                                        <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title" value="{{old('title')}}" {{$errors->has('title')?'autofocus':''}}>
                                        @error('title')<span class="text-danger">{{$message}}</span>@enderror
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Subject :</label>
                                        <input type="text" name="subject" id="subject" value="{{old('subject')}}" class="form-control" placeholder="Enter Subject" {{$errors->has('subject')?'autofocus':''}}>
                                        @error('shortDesc') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                                    <div class="mb-2">
                                        <label>Description :</label>
                                        <textarea name="description" id="description" class="form-control" rows="6" placeholder="Enter Description" {{$errors->has('description')?'autofocus':''}}>{{old('description')}}</textarea>
                                        @error('description') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                                    <div class="text-end mt-4">
                                        <button type="submit" class="btn btn-lg">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="reporter-details mb-4">
                    <div class="heading">
                        <h5>Author</h5>
                    </div>
                    <div class="details-body text-center">
                        <div class="reporter-img">
                            <img src="{{$news_details->user->image_url??''}}" class="img-thumbnail" alt="Creator Image">
                        </div>
                        <h3>{{$news_details->user->name??'Reporter Name'}}</h3>


                        <div class="star-widget">
                            <input type="radio" name="rate" id="rate-5">
                            <label for="rate-5" class="fas fa-star"></label>
                            <input type="radio" name="rate" id="rate-4">
                            <label for="rate-4" class="fas fa-star"></label>
                            <input type="radio" name="rate" id="rate-3">
                            <label for="rate-3" class="fas fa-star"></label>
                            <input type="radio" name="rate" id="rate-2">
                            <label for="rate-2" class="fas fa-star"></label>
                            <input type="radio" name="rate" id="rate-1">
                            <label for="rate-1" class="fas fa-star"></label>
                            <p>
                              <header></header>
                            </p>
                        </div>


                            {{-- <ul>
                                <li><i class="fa-regular fa-star"></i></li>
                                <li><i class="fa-regular fa-star"></i></li>
                                <li><i class="fa-regular fa-star"></i></li>
                                <li><i class="fa-regular fa-star"></i></li>
                                <li><i class="fa-regular fa-star"></i></li>
                            </ul> --}}
                    </div>
                </div>
                <div class="details-sidebar">
                    <div class="sidebar-heading">
                      <h1>Trading News</h1>
                    </div>
                    <div class="sidebar-body">
                        @foreach ($trading_news as $news)
                            <a href="{{route('news.details',$news->id)}}">
                                <div class="sidebar-news">
                                    <div class="sidebar-img">
                                        <img src="{{$news?$news->image_url:''}}" alt="">
                                    </div>
                                    <div class="sidebar-title">
                                        <h2>{{$news?$news->title:''}}</h2>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="details-sidebar mt-4">
                    <div class="sidebar-heading">
                      <h1>Latest News</h1>
                    </div>
                    <div class="sidebar-body">
                        @foreach ($latest_news as $news)
                            <a href="{{route('news.details',$news->id)}}">
                                <div class="sidebar-news">
                                    <div class="sidebar-img">
                                        <img src="{{$news?$news->image_url:''}}" alt="">
                                    </div>
                                    <div class="sidebar-title">
                                        <h2>{{$news?$news->title:''}}</h2>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="related-news mt-5">
                <div class="mb-4">
                    <h4>Related News</h4>
                    <hr>
                </div>
                <div class="row">
                    @foreach ($related_news as $news)
                        <div class="col-3">
                            <a href="{{route('news.details',$news->id)}}">
                                <div class="related-news-content">
                                    <div class="content-img">
                                        <img src="{{$news?$news->image_url:''}}" alt="">
                                    </div>
                                    <div class="content-body">
                                        <dib class="title">
                                            {{$news?$news->title:''}}
                                        </dib>
                                        <div class="subtitle">
                                            {{$news?$news->shortDesc:''}}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection