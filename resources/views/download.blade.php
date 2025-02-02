@extends('admin.layouts.headerSidebar')

@section('title')
    download
@endsection
@push('css')
    <link rel="stylesheet" href="{{asset('assets/download.css')}}">
@endpush
@section('content')
    <div class="download-section">
        <div class="row">
            <div class="col-4 offset-8">
                <div class="download-body">
                    {{-- <h2>Download Page</h2> --}}
                    <a href="" class="btn btn-download mb-2">Preview Project</a>
                    <a href="{{route('download.file')}}" class="btn btn-download mb-2">Download</a>
                    <p class="or-section">Or</p>
                    <a href="" class="btn btn-download mb-2"><i class="fa-brands fa-github"></i> View Source Code</a>
                </div>
            </div>
        </div>
    </div>    

@endsection