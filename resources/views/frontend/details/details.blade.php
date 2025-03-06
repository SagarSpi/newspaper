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
                    <div class="my-3">
                        <p><strong>{{$news_details->shortDesc}}</strong></p>
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
                        <div class="rating-body">
                            <form action="{{route('news.rating-user',$news_details->user->id)}}" method="POST">
                                @csrf
                                <div class="star-widget">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="rate" value="1" id="rate-1" >
                                        <label class="form-check-label" for="rate-1"><i class="fas fa-star"></i></label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="rate" value="2" id="rate-2">
                                        <label class="form-check-label" for="rate-2"><i class="fas fa-star"></i></label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="rate" value="3" id="rate-3">
                                        <label class="form-check-label" for="rate-3"><i class="fas fa-star"></i></label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="rate" value="4" id="rate-4">
                                        <label class="form-check-label" for="rate-4"><i class="fas fa-star"></i></label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="rate" value="5" id="rate-5">
                                        <label class="form-check-label" for="rate-5"><i class="fas fa-star"></i></label>
                                    </div>
                                </div>
                                <div>
                                    <header></header>
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="submit" id="submit-rating" class="btn btn-outline-danger" style="display:none;">Submit Rating</button>
                                </div>
                            </form>
                        </div>
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
                <div class="details-sidebar mt-4">
                    <div class="sidebar-heading">
                        <h1>Latest Tags</h1>
                        <div class="tags-body">
                            @php
                                $tags = explode(',',$news_details->tags)
                            @endphp
                            <div class="text-center my-2">
                                @foreach ($tags as $tag)
                                    <span class="tags-item">{{trim($tag)}}</span>
                                @endforeach
                            </div>
                        </div>
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

@push('script')
    <script src="{{asset('assets/frontend/js/rating.js')}}"></script>
@endpush