@extends('frontend.layout.headerFooter')

@section('title')
    Home 
@endsection

@push('css')
    <link rel="stylesheet" href="{{asset('assets/frontend/css/home.css')}}">
@endpush


@section('content')
    <div class="hero-section">
        <div class="row">
            <div class="col-9">
                <div class="row">
                    <div class="col-8">
                        {{-- head news --}}
                    </div>
                    <div class="col-4">
                        {{-- fore each loop sidebar news   --}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <a href="#">
                            <div class="hero-news-img">
                                <img src="" alt="">
                            </div>
                            <div class="hero-news-details">
                                <div class="title">
                                    {{-- title  --}}
                                </div>
                                <div class="subtitle">
                                    {{-- subtitle  --}}
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-3">
                {{-- fore each top news  --}}
            </div>
        </div>
    </div>
@endsection










