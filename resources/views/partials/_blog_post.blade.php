<div class="blog-post">
    <h2 class="blog-post-title">{{ $post->title }}</h2>
    <p class="blog-post-meta">{{ $post->created_at->toFormattedDateString() }} by 
        <a href="{{ route('users.show', [$post->user]) }}">{{ $post->user->name }}</a>
    </p>

    <p>
        @if (strlen($post->body) > 200)
            {!! substr($post->body, 0, 200) !!}...
        @else
            {!! $post->body !!}
        @endif
    </p>
    <a href="#">Read more</a>
    <h5>Tags:</h5>
    <div>
        @foreach ($post->tags as $tag)
            <a href="#">{{ $tag->name }}</a>
        @endforeach
    </div>
</div><!-- /.blog-post -->
<hr>