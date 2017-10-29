@extends('layouts.main')

@section('blog_main')
    <div class="blog-post">
        <h2 class="blog-post-title">{{ $post->title }}</h2>
        <p class="blog-post-meta">{{ $post->created_at->toFormattedDateString() }} by 
            <a href="{{ route('users.show', [$post->user]) }}">{{ $post->user->name }}</a>
        </p>

        <p>
            {!! $post->body !!}
        </p>
        <hr>
        <h5>Tags:</h5>
        <div>
            @foreach ($tags as $tag)
                <a href="{{ route('tags.show', [$tag]) }}">{{ $tag->name }}</a>
            @endforeach
        </div>
    </div><!-- /.blog-post -->
@endsection