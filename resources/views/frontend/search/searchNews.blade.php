@extends('layouts.headerFooter')

@section('title')
    Search News
@endsection

@push('css')
    <link rel="stylesheet" href="{{asset('assets/frontend/css/searchNews.css')}}">
@endpush

@section('content')
    <div class="search-news-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mb-2">
                    <div>
                        <h4>Results </h4>
                        <hr>
                    </div>
                </div>
                @forelse ($searchNews as $news)
                    <div class="col-4 mb-4">
                        <a href="{{ route('news.details', $news->id) }}">
                            <div class="search-content">
                                <div class="content-img">
                                    <img src="{{ $news ? $news->image_url : '' }}" alt="">
                                </div>
                                <div class="content-body">
                                    <div class="title">
                                        {{ $news ? $news->title : '' }}
                                    </div>
                                    <div class="subtitle">
                                        {{ $news ? $news->shortDesc : '' }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <h5>No News found !</h5>
                    </div>
                @endforelse
                <div>
                    {{$searchNews->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
