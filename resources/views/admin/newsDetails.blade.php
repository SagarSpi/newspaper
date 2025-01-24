@extends('admin.layouts.headerSidebar')

@section('title')
    Details News
@endsection

@push('css')
    <link rel="stylesheet" href="{{asset("assets/admin/css/newsDetails.css")}}">
@endpush

@section('content')
    <div class="details-section">
        <div class="details-top">
            <div class="row">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                          <li class="breadcrumb-item"><a href="{{route('news.index')}}">News</a></li>
                          <li class="breadcrumb-item active" aria-current="page">Details</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="details-body">
            <div class="row">
                <div class="col-6">
                    <div class="row">
                        <div class="col-6">
                            <ul>
                                <li><span>News Id : </span>{{ $news->id ?? 'N/A' }}</li>
                                <li><span>Category : </span>{{ $news->category ?? 'N/A' }}</li>
                                <li><span>Created By : </span>{{ $news->creator_id->name ?? 'Unknown' }}</li>
                                <li><span>Status : </span>{{ $news->status ?? 'N/A' }}</li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <ul>
                                <li><span>Create Date : </span>{{ $news->created_at?->format('H:i d-M-Y') }}</li>
                                <li><span>Update Date : </span>{{ $news->updated_at?->format('H:i d-M-Y') }}</li>
                                <li><span>Delete Date : </span>{{ $news->deleted_at?->format('H:i d-M-Y') }}</li>
                            </ul>
                        </div>
                    </div>
                    <ul>
                        <li><span>Title : </span>{{ $news->title ?? 'N/A' }}</li>
                        <li><span>Summary : </span>{{ $news->shortDesc ?? 'N/A' }}</li>
                        <li><span>Latest Tags : </span>{{ $news->tags ?? 'N/A' }}</li>
                    </ul>
                </div>
                <div class="col-6">
                    <div class="image">
                        <img src="{{$news->image_url}}" alt="News Image">
                    </div>
                </div>
                <div class="col-12">
                    <span>Description :</span>
                    <p class="mt-2">{{ $news->description ?? 'No description available.' }}</p>
                </div>
                <div class="col-12">
                    <div class="back-btn">
                        <a href="{{ route('news.edit', $news->id) }}" class="btn btn-success">Edit News</a>
                        <a href="{{ route('news.index') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection