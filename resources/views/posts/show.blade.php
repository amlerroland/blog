@extends('layouts.main')

@section('blog_main')
    <div class="blog-post">
        @if ($post->ownedByUser(Auth::user()))
            <div class="pull-right">
                <a href="{{ route('posts.edit', [$post]) }}">Edit</a>
                <a href="{{ route('posts.destroy', [$post]) }}" onclick="event.preventDefault();document.getElementById('post_destroy_form_{{ $post->id }}').submit()">Delete</a>
                <form action="{{ route('posts.destroy', [$post]) }}" method="post" id="post_destroy_form_{{ $post->id }}">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                </form>
            </div>
        @endif
        <h2 class="blog-post-title">{{ $post->title }}</h2>
        <p class="blog-post-meta">{{ $post->created_at->toFormattedDateString() }} by 
            <a href="{{ route('users.show', [$post->user]) }}">{{ $post->user->name }}</a>
        </p>

        <p>
            {!! $post->body !!}
        </p>
        <hr>
        <h4>Tags:</h4>
        <div>
            @if ($tags->count())
                @foreach ($tags as $tag)
                    <a href="{{ route('tags.show', [$tag]) }}">{{ $tag->name }}</a>,
                @endforeach
            @else
                <h5>No tags associated with the post</h5>
            @endif
        </div>
    </div>
@endsection