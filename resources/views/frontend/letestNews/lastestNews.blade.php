@extends('layouts.headerFooter')

@section('title')
    Latest News
@endsection

@push('css')
    <link rel="stylesheet" href="{{asset('assets/frontend/css/lastestNews.css')}}">
@endpush

@section('content')
    <!-- hero section start -->
    <div class="all-cat-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-9">
                    <div class="row">
                        <div class="col-8">
                            <a href="{{route('news.details',$lead_news->id)}}">
                                <div class="cat-lead-news">
                                    <div class="cat-lead-news-img">
                                        <img src="{{$lead_news->image_url ?? ''}}" alt="">
                                    </div>
                                    <div class="cat-lead-news-overlay">
                                        <div class="cat-lead-news-title">
                                            {{$lead_news->title ?? 'No title available'}}
                                        </div>
                                        <div class="cat-sub-title">
                                            {{$lead_news->shortDesc ?? 'No summary available'}}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-4 mb-4">
                            @foreach ($lead_news_sidebar as $news)
                                <a href="{{route('news.details',$news->id)}}">
                                    <div class="cat-hero-news">
                                        <div class="cat-hero-news-img">
                                            <img src="{{$news->image_url ?? ''}}" alt="">
                                        </div>
                                        <div class="cat-hero-news-body">
                                            <h2>{{$news->title ?? ''}}</h2>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($latest_news as $news)
                            <div class="col-4 mb-4">
                                <a href="{{route('news.details',$news->id)}}">
                                    <div class="all-cat-content">
                                        <div class="all-cat-content-img">
                                            <img src="{{$news->image_url ?? ''}}" alt="">
                                        </div>
                                        <div class="all-cat-content-body">
                                            <dib class="content-title">
                                                {{$news->title ?? 'N/A'}}
                                            </dib>
                                            <div class="content-subtitle">
                                                {{$news->shortDesc ?? 'N/A'}}
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-3">
                    <div class="all-cat-sidebar">
                        <div class="sidebar-title">
                            <h1>Trending News</h1>
                        </div>
                        <div class="sidebar-body">
                            @foreach ($trading_news_sidebar as $news)
                                <a href="{{route('news.details',$news->id)}}">
                                    <div class="sidebar-news">
                                        <div class="sidebar-news-img">
                                            <img src="{{$news->image_url ?? ''}}" alt="">
                                        </div>
                                        <div class="sidebar-news-title">
                                            <h2>{{$news->title ?? ''}}</h2>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="my-4">
                        <img src="https://res.cloudinary.com/demeqriqu/image/upload/v1737737855/Newspaper/Default_image/news_defalult_image.png" width="300" height="400" alt="">
                    </div>
                    <div class="all-cat-sidebar mt-4">
                        <div class="sidebar-title">
                            <h1>Related News</h1>
                        </div>
                        <div class="sidebar-body">
                            @foreach ($latest_news_sidebar as $news)
                                <a href="{{route('news.details',$news->id)}}">
                                    <div class="sidebar-news">
                                        <div class="sidebar-news-img">
                                            <img src="{{$news->image_url ?? ''}}" alt="">
                                        </div>
                                        <div class="sidebar-news-title">
                                            <h2>{{$news->title ?? ''}}</h2>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- hero section end -->
@endsection