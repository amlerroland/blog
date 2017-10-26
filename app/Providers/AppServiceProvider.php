<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Post;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Create custom polymorphic types
        Relation::morphMap([
            'post' => Post::class,
        ]);

        // During the creation of a post populate the stripped body field
        \App\Models\Post::creating(function($post){
            $post->body_stripped = strip_tags($post->body);
        });

        // After creation of a post populate the slug from the date and title
        \App\Models\Post::created(function($post){
            $post->slug = str_slug($post->created_at . '-' . $post->title);
            $post->update();
        });

        // During post update, update the the title and the stripped body as well
        \App\Models\Post::updated(function($post){
            $post->slug = str_slug($post->created_at . '-' . $post->title);
            $post->body_stripped = strip_tags($post->body);
            $post->update();
        });

        // During the creation of a tag populate the slug field
        \App\Models\Tag::creating(function($tag){
            $tag->slug = str_slug($tag->name);
        }); 
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
