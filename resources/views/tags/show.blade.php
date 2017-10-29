@extends('layouts.main')

@section('blog_main')
    <h2>{{ $tag->name }}</h2>
    <hr>
    @each ('partials._blog_post', $posts, 'post', 'partials._empty')
    {{ $posts->links() }}
@endsection