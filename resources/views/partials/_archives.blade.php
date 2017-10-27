<div class="sidebar-module">
    <h4>Archives</h4>
    <ol class="list-unstyled">
        @foreach ($archives as $month)
            <li>
                <a href="/?month={{ $month['month'] }}&year={{ $month['year'] }}">
                    {{ $month['month'] . ' ' . $month['year'] }}
                </a>
            </li>
        @endforeach
    </ol>
</div>