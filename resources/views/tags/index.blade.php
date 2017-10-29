@extends('layouts.main')

@section('blog_main')
    <h2>Tags</h2>
    <hr>
    <div class="row">
        @foreach ($tags as $tag)
            <div class="col-md-3">
                <a href="{{ route('tags.show', [$tag]) }}">{{ $tag->name }}</a><span>({{ $tag->posts_count }})</span>
            </div>
        @endforeach
    </div>
@endsection