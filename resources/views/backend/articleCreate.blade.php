@extends('backend.layouts.headerSidebar')

@section('title')
    Create News
@endsection
@push('css')
    {{-- Bootstrap Tags Input CDN Link  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css"/>
    <link rel="stylesheet" href="{{asset('assets/backend/css/articleCreate.css')}}">
@endpush

@section('content')
    <div class="create-article-section">
        <div class="row">
            <div class="col-6">
                <div class="heading">
                    <h5>Create Article</h5>
                </div>
            </div>
            <div class="col-6">
                <div class="article-list-btn">
                    <a href="{{route('article.list')}}" class="btn btn-success btn-sm">Article List</a>
                </div>
            </div>
        </div>
        <div class="create-article-body">
            <div class="row">
                <div class="col-10 offset-1">
                    <form action="{{route('article.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-2">
                            <label class="form-label">Title :</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title" value="{{old('title')}}" {{$errors->has('title')?'autofocus':''}}>
                            @error('title')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="mb-2">
                            <label>Category :</label>
                            <select name="category" id="category" class="form-control" {{$errors->has('category')?'autofocus':''}}>
                                <option value="">Select Category</option>
                                <option value="Politics" {{old('category')=='Politics'?'selected':''}}>Politics</option>
                                <option value="Business"{{old('category')=='Business'?'selected':''}}>Business</option>
                                <option value="Sports" {{old('category')=='Sports'?'selected':''}}>Sports</option>
                                <option value="Crime" {{old('category')=='Crime'?'selected':''}}>Crime</option>
                                <option value="Lifestyle" {{old('category')=='Lifestyle'?'selected':''}}>Lifestyle</option>
                                <option value="Education"{{old('category')=='Education'?'selected':''}}>Education</option>
                                <option value="Bangladesh"{{old('category')=='Bangladesh'?'selected':''}}>Bangladesh</option>
                                <option value="Entertainment"{{old('category')=='Entertainment'?'selected':''}}>Entertainment</option>
                                <option value="International"{{old('category')=='International'?'selected':''}}>International</option>
                            </select>
                            @error('category')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Summary :</label>
                            <input type="text" value="{{old('shortDesc')}}" name="shortDesc" id="shortDesc" class="form-control" placeholder="Enter Summary" {{$errors->has('shortDesc')?'autofocus':''}}>
                            @error('shortDesc') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="mb-2">
                            <label>Description : </label>
                            <textarea name="description" id="description" class="form-control" placeholder="Enter Description" {{$errors->has('description')?'autofocus':''}}>{{old('description')}}</textarea>
                            @error('description') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="mb-2">
                            <label>Upload Image :</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*">
                            @error('image')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="input-group my-4">
                            <span class="input-group-text">Tags :</span>
                            <input type="text" value="{{old('tags')}}" name="tags" id="tags_input" data-role="tagsinput" class="form-control" placeholder="Enter Tags" {{$errors->has('tags')?'autofocus':''}}>
                            {{-- <span class="input-group-text">Created by :</span>
                            <input type="text" value="{{old('creator')}}" name="creator" class="form-control" placeholder="Enter Creator Name" {{$errors->has('creator')?'autofocus':''}}> --}}
                        </div>
                        <div>
                            @error('tags')<span class="text-danger">{{$message}}</span>@enderror
                            @error('creator')<span class="text-danger">{{$message}}</span>@enderror
                            <p id="tags_error" style="color: red; display: none;">You can add a maximum of 4 tags.</p>
                        </div>
                        <button type="submit" class="btn btn-success">Submit Article</button>
                        <button type="button" onclick="window.location.reload();" class="btn btn-danger mx-2">Discard <i class="fa-solid fa-trash"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('script')
    {{-- Bootstrap Tags Input CDN Link  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
    {{-- CK Editor CDN Link  --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
    <script src="{{asset('assets/backend/js/ckEditor.js')}}"></script>
    {{-- Tags Input Js file  --}}
    <script src="{{asset('assets/backend/js/tagEventHandle.js')}}"></script>
@endpush