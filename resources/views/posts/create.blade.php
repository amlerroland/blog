@extends('layouts.main')

@section('links')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
@endsection

@section('blog_main')
    <h2>Create a new post</h2>
    @php
        if(!isset($post)){
            $post = null;
        }
    @endphp
    <form action="{{ route('posts.store') }}" method="post" accept-charset="utf-8">
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
            <label for="title" class="control-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') ? old('title') : '' }}">
            @if ($errors->has('title'))
                <span class="help-block">{{ $errors->first('title') }}</span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
            <label for="body" class="control-label">Post</label>
            <textarea class="form-control" name="body" id="body" rows="10">{{ old('body') }}</textarea>
            @if ($errors->has('body'))
                <span class="help-block">{{ $errors->first('body') }}</span>
            @endif
        </div>

        <div class="form-group{{ ($errors->has('tags') || $errors->has('tags.*')) ? ' has-error' : '' }}">
            <label for="tags" class="control-label">Tags</label>
            <select name="tags[]" class="form-control js-example-basic-multiple" multiple="multiple">
                @if (is_array(old('tags')) && old('tags'))
                    @foreach ($tags as $tag)
                        @if (in_array($tag->id, old('tags')))
                            <option value="{{ $tag->id }}" selected="selected">{{ $tag->name }}</option>
                        @else
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endif
                    @endforeach
                @else
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                @endif
            </select>
            @if ($errors->has('tags') || $errors->has('tags.*'))
                <span class="help-block">{{ $errors->first('tags.*') ? $errors->first('tags.*') : $errors->first('tags') }}</span>
            @endif
        </div>
        
        <button type="submit" class="btn btn-primary">Save</button>
        
    </form>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
    <script src="{{ asset('js/posts.js') }}"></script>
@endsection