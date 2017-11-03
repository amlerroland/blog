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
        @if (strlen($post->body) > 1000)
            {!! substr($post->body, 0, 1000) !!}...
        @else
            {!! $post->body !!}
        @endif
    </p>
    <a href="{{ route('posts.show', [$post]) }}">Read more</a>
    <h4>Tags:</h4>
    <div>
        @if ($post->tags->count())
            @foreach ($post->tags as $tag)
                <a href="{{ route('tags.show', [$tag]) }}">{{ $tag->name }}</a>,
            @endforeach
        @else
            <h5>No tags associated with the post</h5>
        @endif
    </div>
</div>
<hr>