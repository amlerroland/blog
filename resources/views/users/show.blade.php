@extends('layouts.main')

@section('blog_main')
    <h3>{{ $user->name }}</h3>
    @each ('partials._blog_post', $posts, 'post', 'partials._empty')
    {{ $posts->links() }}
@endsection