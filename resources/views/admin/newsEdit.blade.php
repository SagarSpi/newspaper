@extends('admin.layouts.headerSidebar')

@section('title')
    Update News
@endsection

@push('css')
    {{-- Bootstrap Tags Input CDN Link  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css"/>
    <link rel="stylesheet" href="{{asset('assets/admin/css/newsEdit.css')}}">
@endpush

@section('content')
    <div class="edit-news-section">
        <div class="row">
            <div class="col-12">
                <div class="heading">
                    <h1>Update News</h1>
                </div>
            </div>
        </div>
        <div class="edit-news-body">
            <div class="row">
                <div class="col-10 offset-1">
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-2">
                            <label for="title" class="form-label">Title :</label>
                            <input type="text" value="{{old('title')}}" name="title" id="title" class="form-control" placeholder="Enter Title" >
                        </div>
                        <div class="mb-2">
                            <label for="category">Category :</label>
                            <select name="category" id="category" class="form-control">
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
                        </div>
                        <div class="mb-2">
                            <label for="shortDesc" class="form-label">Summary :</label>
                            <input type="text" value="{{old('shortDesc')}}" name="shortDesc" id="shortDesc" class="form-control" placeholder="Enter Summary" >
                        </div>
                        <div class="mb-2">
                            <label for="description">Description : </label>
                            <textarea name="description" id="description" class="form-control" placeholder="Enter Description">{{old('description')}}</textarea>
                        </div>
                        <div class="mb-2">
                            <label for="image">Upload Image :</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*">
                        </div>
                        <div class="input-group my-4">
                            <span class="input-group-text" id="tags">Tags :</span>
                            <input type="text" value="{{old('tags')}}" name="tags" id="tags_input" data-role="tagsinput" class="form-control" placeholder="Enter Tags">
                            <span class="input-group-text" id="author">Author :</span>
                            <input type="text" value="{{old('author')}}" name="author" class="form-control" placeholder="Enter Creator Name">
                        </div>
                        <button type="submit" class="btn btn-success">Submit News</button>
                        <a href="" class="btn btn-danger mx-2">Discard <i class="fa-solid fa-trash"></i></a>
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
    <script src="{{asset('assets/admin/js/ckEditor.js')}}"></script>
@endpush

