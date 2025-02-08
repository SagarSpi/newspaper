@extends('backend.layouts.headerSidebar')

@section('title')
    Edit Article
@endsection

@push('css')
    {{-- Bootstrap Tags Input CDN Link  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css"/>
    <link rel="stylesheet" href="{{asset('assets/backend/css/articleEdit.css')}}">
@endpush

@section('content')
    <div class="edit-article-section">
        <div class="row">
            <div class="col-6">
                <div class="heading">
                    <h5>Edit Article</h5>
                </div>
            </div>
            <div class="col-6">
                <div class="text-end">
                    <a href="{{route('article.list')}}" class="btn btn-success btn-sm">Back To Article List</a>
                </div>
            </div>
        </div>
        <div class="edit-article-body">
            <div class="row">
                <div class="col-10 offset-1">
                    <form action="{{route('article.update',$article->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-2">
                            <label class="form-label">Title :</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title" value="{{old('title',$article->title)}}" {{$errors->has('title')?'autofocus':''}}>
                            @error('title')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="mb-2">
                            <label>Category :</label>
                            <select name="category" id="category" class="form-control" {{$errors->has('category')?'autofocus':''}}>
                                <option value="">Select Category</option>
                                <option value="Politics" {{old('category', $article->category ?? '')=='Politics'?'selected':''}}>Politics</option>
                                <option value="Business"{{old('category', $article->category ?? '')=='Business'?'selected':''}}>Business</option>
                                <option value="Sports" {{old('category', $article->category ?? '')=='Sports'?'selected':''}}>Sports</option>
                                <option value="Crime" {{old('category', $article->category ?? '')=='Crime'?'selected':''}}>Crime</option>
                                <option value="Lifestyle" {{old('category', $article->category ?? '')=='Lifestyle'?'selected':''}}>Lifestyle</option>
                                <option value="Education"{{old('category', $article->category ?? '')=='Education'?'selected':''}}>Education</option>
                                <option value="Bangladesh"{{old('category', $article->category ?? '')=='Bangladesh'?'selected':''}}>Bangladesh</option>
                                <option value="Entertainment"{{old('category', $article->category ?? '')=='Entertainment'?'selected':''}}>Entertainment</option>
                                <option value="International"{{old('category', $article->category ?? '')=='International'?'selected':''}}>International</option>
                            </select>
                            @error('category')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Summary :</label>
                            <input type="text" value="{{old('shortDesc', $article->shortDesc ?? '')}}" name="shortDesc" id="shortDesc" class="form-control" placeholder="Enter Summary" {{$errors->has('shortDesc')?'autofocus':''}}>
                            @error('shortDesc') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="mb-2">
                            <label>Description : </label>
                            <textarea name="description" id="description" class="form-control" placeholder="Enter Description" {{$errors->has('description')?'autofocus':''}}>{{old('description', $article->description ?? '')}}</textarea>
                            @error('description') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="mb-2">
                            <label>Upload Image :</label>
                            <input type="file" onchange="document.querySelector('#output').src=window.URL.createObjectURL(this.files[0])" name="image" class="form-control" accept="image/*">
                            @error('image')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="py-3">
                            <img src="{{$article->image_url ?? ''}}" id="output" alt="" class="img-thumbnail"  width="200px" height="120px">
                        </div>
                        <div class="input-group my-4">
                            <span class="input-group-text">Tags :</span>
                            <input type="text" value="{{old('tags', $article->tags ?? '')}}" name="tags" id="tags_input" data-role="tagsinput" class="form-control" placeholder="Enter Tags" {{$errors->has('tags')?'autofocus':''}}>
                        </div>
                        <div>
                            @error('tags')<span class="text-danger">{{$message}}</span>@enderror
                            @error('creator')<span class="text-danger">{{$message}}</span>@enderror
                            <p id="tags_error" style="color: red; display: none;">You can add a maximum of 4 tags.</p>
                        </div>
                        <button type="submit" class="btn btn-success">Submit Changes</button>
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
@endpush

