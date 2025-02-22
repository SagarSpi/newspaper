@extends('backend.layouts.headerSidebar')

@section('title')
    Comment Edit
@endsection

@section('content')
    <div class="comments-section">
        <div class="row">
            <div class="col-12">
                <h4 class="mb-4">Update Comment</h4>
            </div>
            <div class="col-10 offset-1">
                <div class="comment-body">
                    
                    <form action="{{route('comment.update',$comment->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-2">
                            <label class="form-label">Title :</label>
                            <input type="text" name="title" value="{{old('title',$comment->title)}}" id="title" class="form-control" placeholder="Enter Title" {{$errors->has('title')?'autofocus':''}}>
                            @error('title')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Subject :</label>
                            <input type="text" name="subject" id="subject" value="{{old('subject',$comment->subject)}}" class="form-control" placeholder="Enter Subject" {{$errors->has('subject')?'autofocus':''}}>
                            @error('shortDesc') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="mb-2">
                            <label>Description :</label>
                            <textarea name="description" id="description" class="form-control" rows="10" placeholder="Enter Description" {{$errors->has('description')?'autofocus':''}}>{{old('description',$comment->description)}}</textarea>
                            @error('description') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection