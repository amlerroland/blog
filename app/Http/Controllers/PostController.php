<?php

namespace App\Http\Controllers;

use App\Models\{Post, Tag};
use Illuminate\Http\Request;
use App\Http\Requests\PostCreateEditRequest;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show', 'archives');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Post::latest()
            ->filter(request(['month', 'year']))
            ->with('user', 'tags')
            ->paginate(10);

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::orderBy('name')->get();

        return view('posts.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCreateEditRequest $request)
    {
        $post = new Post;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user()->associate($request->user());

        $post->save();

        // Tags are coming here
        $tag_array = [];

        if ($request->tags) {
            foreach ($request->tags as $key => $tag_id) {
                if ( intval($tag_id) > 0 ) {
                    $tag_array[] = abs($tag_id);
                } else {
                    $new_tag = new Tag;
                    $new_tag->name = $tag_id;

                    $new_tag->save();
                    $tag_array[] = $new_tag->id;
                };
            }
        }

        $post->tags()->sync($tag_array);
        
        return redirect()->route('posts.show', [$post])->withSuccess('Your post has been successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $tags = $post->tags;

        return view('posts.show', compact('post', 'tags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $post = Post::where('id', $post->id)->with('tags')->first();

        // dd($post->tags->pluck('id')->toArray());

        // Remember the policy to validate that i can actually edit
        $this->authorize('update', $post);

        $tags = Tag::orderBy('name')->get();

        return view('posts.edit', compact('post', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostCreateEditRequest $request, Post $post)
    {
        $this->authorize('update', $post);

        $post->title = $request->title;
        $post->body = $request->body;

        $post->update();

        // Tags are coming here
         
        $tag_array = [];

        if ($request->tags) {
            foreach ($request->tags as $key => $tag_id) {
                if ( intval($tag_id) > 0 ) {
                    $tag_array[] = abs($tag_id);
                } else {
                    $new_tag = new Tag;
                    $new_tag->name = $tag_id;

                    $new_tag->save();
                    $tag_array[] = $new_tag->id;
                };
            }
        }

        $post->tags()->sync($tag_array);
        
        return redirect()->route('posts.show', [$post])->withSuccess('Your post has been successfully edited.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        
        // Detach the tags from the post
        $post->tags()->detach();
        
        $post->delete();

        return redirect()->route('posts.index')->withSuccess('Your post has been successfully deleted.');
    }

    public function archives()
    {
        return view('posts.archives');
    }
    
}
