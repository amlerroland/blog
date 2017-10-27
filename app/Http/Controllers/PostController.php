<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
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
            ->simplePaginate(10);

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);

        // Validate the tags as well
        $this->validate($request, [
            'title' => 'required|min:2|max:255',
            'body' => 'required|min:2',
        ]);

        $post = new Post;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user()->associate($request->user);

        $post->save();

        // Tags are coming here
        
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
        // Remember the policy to validate that i can actually edit
        $tags = $post->tags;

        return view('posts.edit', compact('post', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        dd($request);
        // Remember the policy to validate that i can actually edit

        // Validate the tags as well
        $this->validate($request, [
            'title' => 'required|min:2|max:255',
            'body' => 'required|min:2',
        ]);

        $post->title = $request->title;
        $post->body = $request->body;

        // Remember to update the slug and the stripped body in the service provider

        $post->update();

        // Tags are coming here
        
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
        // Remember the policy to validate that i can actually edit
        
        // Detach the tags from the post or just set it up in the migration TEST!!!
        
        $post->delete();

        return redirect()->route('posts.index')->withSuccess('Your post has been successfully deleted.');
    }
}
