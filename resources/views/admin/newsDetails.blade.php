@extends('admin.layouts.headerSidebar')

@section('title')
    Details News
@endsection

@section('content')
{{$news->id}}
<br>
{{ $news->title }}
<br>
{{ $news->category }}
<br>
{{ $news->shortDesc }}
<br>
{{ $news->description }}
<br>
{{ $news->tags }}
<br>
{{ $news->status }}
<br>
{{ $news->creator_id}}
<br>
{{ $news->created_at}}
<br>
{{ $news->updated_at}}
<br>
{{ $news->deleted_at}}
@endsection