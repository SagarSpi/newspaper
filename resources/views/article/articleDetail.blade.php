@extends('layouts.headerSidebar')

@section('title')
    Details News
@endsection

@push('css')
    <link rel="stylesheet" href="{{asset("assets/backend/css/articleDetails.css")}}">
@endpush

@section('content')
    <div class="details-section">
        <div class="details-top">
            <div class="row">
                <div class="col-12">
                    <div class="back-btn">
                        <a href="{{ route('article.edit', $article->id) }}" class="btn btn-success btn-sm">Edit Article</a>
                        <a href="{{ route('article.list') }}" class="btn btn-primary btn-sm">Back To Article</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="details-body">
            <div class="row">
                <div class="col-6">
                    <div class="row">
                        <div class="col-6">
                            <ul>
                                <li><span>News Id : </span>{{ $article->id ?? 'N/A' }}</li>
                                <li><span>Category : </span>{{ $article->category ?? 'N/A' }}</li>
                                <li><span>Created By : </span>{{ $article->user->name ?? 'Unknown' }}</li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <ul>
                                <li><span>Create Date : </span>{{ $article->created_at ?? 'N/A' }}</li>
                                <li><span>Update Date : </span>{{ $article->updated_at ?? 'N/A' }}</li>
                                <li><span>Status : </span>{{ $article->status ?? 'N/A' }}</li>
                            </ul>
                        </div>
                    </div>
                    <ul>
                        <li><span>Title : </span>{{ $article->title ?? 'N/A' }}</li>
                        <li><span>Summary : </span>{{ $article->shortDesc ?? 'N/A' }}</li>
                        <li><span>Latest Tags : </span>{{ $article->tags ?? 'N/A' }}</li>
                    </ul>
                </div>
                <div class="col-6">
                    <div class="image">
                        <img src="{{$article->image_url}}" class="img-thumbnail" alt="News Image">
                    </div>
                </div>
                <div class="col-12">
                    <span>Description :</span>
                    <p class="mt-2">{!! $article->description ?? 'No description available.' !!}</p>
                </div>
            </div>
        </div>
    </div>
@endsection