@extends('layouts.main')

@section('blog_main')
    @each ('partials._blog_post', $posts, 'post', 'partials._empty')
@endsection