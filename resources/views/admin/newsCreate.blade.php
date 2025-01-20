@extends('admin.layouts.headerSidebar')

@section('title')
    Create News
@endsection
@push('css')
    {{-- Bootstrap Tags Input CDN Link  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css"/>
    <link rel="stylesheet" href="{{asset('assets/admin/css/newsCreate.css')}}">
@endpush

@section('content')
    <div class="create-news-section">
        <div class="row">
            <div class="col-12">
                <div class="heading">
                    <h1>Create News</h1>
                </div>
            </div>
        </div>
        <div class="create-news-body">
            <div class="row">
                <div class="col-10 offset-1">
                    <form action="" method="POST">
                        <div class="mb-2">
                            <label for="title" class="form-label">Title :</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title" >
                        </div>
                        <div class="mb-2">
                            <label for="category">Category :</label>
                            <select name="category" id="category" class="form-control">
                                <option value="">Select Category</option>
                                <option value="Politics">Politics</option>
                                <option value="Business">Business</option>
                                <option value="Sports">Sports</option>
                                <option value="Crime">Crime</option>
                                <option value="Lifestyle">Lifestyle</option>
                                <option value="Education">Education</option>
                                <option value="Bangladesh">Bangladesh</option>
                                <option value="Entertainment">Entertainment</option>
                                <option value="International">International</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="shortDesc" class="form-label">Summary :</label>
                            <input type="text" name="shortDesc" id="shortDesc" class="form-control" placeholder="Enter Summary" >
                        </div>
                        <div class="mb-2">
                            <label for="description">Description : </label>
                            <textarea name="description" id="description" class="form-control" placeholder="Enter Description"></textarea>
                        </div>
                        <div class="mb-2">
                            <label for="image">Upload Image :</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*">
                        </div>
                        <div class="input-group my-4">
                            <span class="input-group-text" id="tags">Tags :</span>
                            <input type="text" name="tags" id="tags_input" data-role="tagsinput" class="form-control" placeholder="Enter Tags">
                            <span class="input-group-text" id="author">Author :</span>
                            <input type="text" name="author"class="form-control" placeholder="Enter Creator Name">
                        </div>
                        <button type="submit" class="btn btn-success">Submit News</button>
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