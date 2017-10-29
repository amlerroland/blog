@extends('layouts.app')

@section('page_header')
    @include('partials._page_header')
@endsection

@section('content')
    <div class="row">

        <div class="col-sm-9 blog-main">
            @yield('blog_main')

        </div><!-- /.blog-main -->

        <aside class="col-sm-3 ml-sm-auto blog-sidebar">
          @include('partials._archives')
          @include('partials._tags')
        </aside><!-- /.blog-sidebar -->

      </div><!-- /.row -->
@endsection