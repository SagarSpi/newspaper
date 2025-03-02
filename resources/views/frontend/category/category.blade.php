@extends('layouts.headerFooter')

@section('title')
    Category
@endsection

@push('css')
    <link rel="stylesheet" href="{{asset('assets/frontend/css/category.css')}}">
@endpush

@section('content')
    <div class="cat-section">
        <div class="row">
            <div class="col-9">
                <div class="row">
                    <div class="col-8">
                        <div class="lead-news">
                            <a href="{{route('news.details',$lead_news->id??'')}}">
                                <div class="lead-news-img">
                                    <img src="{{ $lead_news->image_url ?? '' }}" alt="News Image">
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
                                        <img src="{{$news?$news->image_url:''}}" alt="">
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
                    @foreach ($cat_news as $news)
                        <div class="col-4 mb-4">
                            <a href="{{route('news.details',$news->id)}}">
                                <div class="cat-content">
                                    <div class="cat-content-img">
                                        <img src="{{$news?$news->image_url:''}}" alt="">
                                    </div>
                                    <div class="cat-content-body">
                                        <div class="content-title">
                                            {{$news?$news->title:''}}
                                        </div>
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
                <div class="cat-menu mb-4">
                    <div class="menu-title">
                        <h5>Top Categories</h5>
                    </div>
                    <div class="menu-body">
                        <ul>
                            <li>
                                <a href="{{ route('news.category', ['cat' => 'Politics']) }}" class="menu-item"><i class="fa-solid fa-caret-right fa-lg"></i> Politics</a>
                            </li>
                            <li>
                                <a href="{{ route('news.category', ['cat' => 'Business']) }}" class="menu-item"><i class="fa-solid fa-caret-right fa-lg"></i> Business</a>
                            </li>
                            <li>
                                <a href="{{ route('news.category', ['cat' => 'Science_technolog']) }}" class="menu-item"><i class="fa-solid fa-caret-right fa-lg"></i> Science & Technology</a>
                            </li>
                            <li>
                                <a href="{{ route('news.category', ['cat' => 'Education']) }}" class="menu-item"><i class="fa-solid fa-caret-right fa-lg"></i> Education</a>
                            </li>
                            <li>
                                <a href="{{ route('news.category', ['cat' => 'Sports']) }}" class="menu-item"><i class="fa-solid fa-caret-right fa-lg"></i> Sports</a>
                            </li>
                            <li>
                                <a href="{{ route('news.category', ['cat' => 'Corporate']) }}" class="menu-item"><i class="fa-solid fa-caret-right fa-lg"></i> Corporate</a>
                            </li>
                            <li>
                                <a href="{{ route('news.category', ['cat' => 'Opinion']) }}" class="menu-item"><i class="fa-solid fa-caret-right fa-lg"></i> Opinion</a>
                            </li>
                            <li>
                                <a href="{{ route('news.category', ['cat' => 'International']) }}" class="menu-item"><i class="fa-solid fa-caret-right fa-lg"></i> International</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="cat-sidebar">
                    <div class="cat-sidebar-heading">
                      <h1>Top News</h1>
                    </div>
                    <div class="sidebar-body">
                        @foreach ($cat_news_side as $news)
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
        </div>
    </div>
@endsection