@extends('layouts.headerFooter')

@section('title')
    Home 
@endsection

@push('css')
    <link rel="stylesheet" href="{{asset('assets/frontend/css/home.css')}}">
@endpush

@section('content')
    {{-- HOREO SECTION CODE START  --}}
    <div class="hero-section">
        <div class="row">
            <div class="col-9">
                <div class="row">
                    <div class="col-8">
                        <div class="lead-news">
                            <a href="{{route('news.details',$lead_news->id ??'')}}">
                                <div class="lead-news-img">
                                    <img src="{{ $lead_news->image_url ??''}}" alt="Lead image">
                                </div>
                                <div class="lead-news-overlay">
                                    <div class="title">
                                        {{ $lead_news->title ?? 'No title available' }}
                                    </div>
                                    <div class="subtitle">
                                        {{ $lead_news->shortDesc ?? 'No summary available' }}
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-4">
                        @foreach ($lead_news_side as $news)
                            <a href="{{route('news.details',$news->id)}}">
                                <div class="lead-news-sidebar">
                                    <div class="sidebar-img">
                                        <img src="{{$news?$news->image_url: ''}}" alt="">
                                    </div>
                                    <div class="sidebar-title">
                                        <h5>{{$news?$news->title:''}}</h5>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="row mt-4">
                    @foreach ($hero_news as $news)
                        <div class="col-4 mb-4">
                            <a href="{{route('news.details',$news->id)}}">
                                <div class="hero-content">
                                    <div class="hero-content-img">
                                        <img src="{{$news?$news->image_url:''}}" alt="">
                                    </div>
                                    <div class="hero-content-body">
                                        <dib class="content-title">
                                            {{$news?$news->title:''}}
                                        </dib>
                                        <div class="content-subtitle">
                                            {{$news?$news->shortDesc:''}}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-3">
                <div class="hero-sidebar">
                    <div class="hero-sidebar-heading">
                      <h1>Top News</h1>
                    </div>
                    <div class="sidebar-body">
                        @foreach ($hero_news_side as $news)
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
                <div class="cat-menu my-4">
                    <div class="menu-title">
                        <h5>Top Categories</h5>
                    </div>
                    <div class="menu-body">
                        <ul>
                            <li><a href="" class="menu-item"><i class="fa-solid fa-caret-right fa-lg"></i> Politics</a></li>
                            <li><a href="" class="menu-item"><i class="fa-solid fa-caret-right fa-lg"></i> Business</a></li>
                            <li><a href="" class="menu-item"><i class="fa-solid fa-caret-right fa-lg"></i> Lifestyle</a></li>
                            <li><a href="" class="menu-item"><i class="fa-solid fa-caret-right fa-lg"></i> Crime</a></li>
                            <li><a href="" class="menu-item"><i class="fa-solid fa-caret-right fa-lg"></i> Education</a></li>
                            <li><a href="" class="menu-item"><i class="fa-solid fa-caret-right fa-lg"></i> Sports</a></li>
                            <li><a href="" class="menu-item"><i class="fa-solid fa-caret-right fa-lg"></i> Entertainment</a></li>
                            <li><a href="" class="menu-item"><i class="fa-solid fa-caret-right fa-lg"></i> International</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- HOREO SECTION CODE END  --}}
    {{-- CATEGORY SECTION CODE START  --}}
    <div class="category-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="category-title">
                        <h1>Political News</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="cat-sidebar">
                        <div class="cat-sidebar-title">
                            <h1>Top News</h1>
                        </div>
                        <div class="cat-sidebar-body">
                            @foreach ($politics_news_side as $news)
                                <a href="{{route('news.details',$news->id)}}">
                                    <div class="cat-sidebar-news">
                                        <div class="cat-sideber-img">
                                            <img src="{{$news?$news->image_url:''}}" alt="">
                                        </div>
                                        <div class="cat-sideber-heading">
                                            <h2>{{$news?$news->title:''}}</h2>
                                        </div>
                                    </div>  
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <div class="row">
                        @foreach ($politics_news as $news)
                            <div class="col-4 mb-4">
                                <a href="{{route('news.details',$news->id)}}">
                                    <div class="category-content">
                                        <div class="category-content-img">
                                            <img src="{{$news?$news->image_url:''}}" alt="">
                                        </div>
                                        <div class="category-body">
                                            <div class="category-title">
                                                {{$news?$news->title:''}}
                                            </div>
                                            <div class="category-subtitle">
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
    </div>
    {{-- CATEGORY SECTION CODE EMD --}}
    {{-- CATEGORY SECTION CODE START  --}}
    <div class="category-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="category-title">
                        <h1>Business News</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <div class="row">

                        @foreach ($business_news as $news)
                            <div class="col-4 mb-4">
                                <a href="{{route('news.details',$news->id)}}">
                                    <div class="category-content">
                                        <div class="category-content-img">
                                            <img src="{{$news?$news->image_url:''}}" alt="">
                                        </div>
                                        <div class="category-body">
                                            <div class="category-title">
                                                {{$news?$news->title:''}}
                                            </div>
                                            <div class="category-subtitle">
                                                {{$news?$news->shortDesc:''}}
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-4">
                    <div class="cat-sidebar">
                        <div class="cat-sidebar-title">
                            <h1>Top News</h1>
                        </div>
                        <div class="cat-sidebar-body">
                            @foreach ($business_news_side as $news)
                                <a href="{{route('news.details',$news->id)}}">
                                    <div class="cat-sidebar-news">
                                        <div class="cat-sideber-img">
                                            <img src="{{$news?$news->image_url:''}}" alt="">
                                        </div>
                                        <div class="cat-sideber-heading">
                                            <h2>{{$news?$news->title:''}}</h2>
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
    {{-- CATEGORY SECTION CODE EMD --}}
    {{-- CATEGORY SECTION CODE START  --}}
    <div class="category-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="category-title">
                        <h1>Sports News</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="cat-sidebar">
                        <div class="cat-sidebar-title">
                            <h1>Top News</h1>
                        </div>
                        <div class="cat-sidebar-body">
                            @foreach ($sports_news_side as $news)
                                <a href="{{route('news.details',$news->id)}}">
                                    <div class="cat-sidebar-news">
                                        <div class="cat-sideber-img">
                                            <img src="{{$news?$news->image_url:''}}" alt="">
                                        </div>
                                        <div class="cat-sideber-heading">
                                            <h2>{{$news?$news->title:''}}</h2>
                                        </div>
                                    </div>  
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <div class="row">
                        @foreach ($sports_news as $news)
                            <div class="col-4 mb-4">
                                <a href="{{route('news.details',$news->id)}}">
                                    <div class="category-content">
                                        <div class="category-content-img">
                                            <img src="{{$news?$news->image_url:''}}" alt="">
                                        </div>
                                        <div class="category-body">
                                            <div class="category-title">
                                                {{$news?$news->title:''}}
                                            </div>
                                            <div class="category-subtitle">
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
    </div>
    {{-- CATEGORY SECTION CODE EMD --}}
    {{-- CATEGORY SECTION CODE START  --}}
    <div class="category-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="category-title">
                        <h1>Education News</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <div class="row">
                        @foreach ($education_news as $news)
                            <div class="col-4 mb-4">
                                <a href="{{route('news.details',$news->id)}}">
                                    <div class="category-content">
                                        <div class="category-content-img">
                                            <img src="{{$news?$news->image_url:''}}" alt="">
                                        </div>
                                        <div class="category-body">
                                            <div class="category-title">
                                                {{$news?$news->title:''}}
                                            </div>
                                            <div class="category-subtitle">
                                                {{$news?$news->shortDesc:''}}
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-4">
                    <div class="cat-sidebar">
                        <div class="cat-sidebar-title">
                            <h1>Top News</h1>
                        </div>
                        <div class="cat-sidebar-body">
                            @foreach ($education_news_side as $news)
                                <a href="{{route('news.details',$news->id)}}">
                                    <div class="cat-sidebar-news">
                                        <div class="cat-sideber-img">
                                            <img src="{{$news?$news->image_url:''}}" alt="">
                                        </div>
                                        <div class="cat-sideber-heading">
                                            <h2>{{$news?$news->title:''}}</h2>
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
    {{-- CATEGORY SECTION CODE EMD --}}
@endsection










