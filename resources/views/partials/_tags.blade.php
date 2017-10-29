<div class="sidebar-module">
    <h4>Tags</h4>
    <ol class="list-unstyled">
        @foreach ($tags_sidebar as $tag)
            <li><a href="{{ route('tags.show', [$tag]) }}">{{ $tag->name }}</a></li>
        @endforeach
        <hr class="side-separator">
        <li><a href="{{ route('tags.index') }}">All tags</a></li>
    </ol>
</div>