<div class="sidebar-module">
    <h4>Archives</h4>
    <ol class="list-unstyled">
        @foreach ($archives_sliced as $month)
            <li>
                <a href="/?month={{ $month['month'] }}&year={{ $month['year'] }}">
                    {{ $month['month'] . ' ' . $month['year'] }}
                </a>
            </li>
        @endforeach
        <hr class="side-separator">
        <li><a href="{{ route('posts.archives') }}">Full archives</a></li>
    </ol>
</div>