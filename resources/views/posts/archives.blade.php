@extends('layouts.main')

@section('blog_main')
    <div class="row">
        @foreach ($archives_full as $month)
            <div class="col-md-3">
                <a href="/?month={{ $month['month'] }}&year={{ $month['year'] }}">
                    {{ $month['month'] . ' ' . $month['year'] }}
                </a>
            </div>
        @endforeach
    </div>
@endsection