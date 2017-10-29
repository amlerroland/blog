<div class="blog-post">
    <h2 class="blog-post-title">{{ $post->title }}</h2>
    <p class="blog-post-meta">{{ $post->created_at->toFormattedDateString() }} by 
        <a href="{{ route('users.show', [$post->user]) }}">{{ $post->user->name }}</a>
    </p>

    <p>
        @if (strlen($post->body) > 1000)
            {!! substr($post->body, 0, 1000) !!}...
        @else
            {!! $post->body !!}
        @endif
    </p>
    <a href="{{ route('posts.show', [$post]) }}">Read more</a>
    <h5>Tags:</h5>
    <div>
        @foreach ($post->tags as $tag)
            <a href="{{ route('tags.show', [$tag]) }}">{{ $tag->name }}</a>
        @endforeach
    </div>
</div>
<hr>