<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);

        
        // View composer for archives
        view()->composer(['partials._archives', 'posts.archives'], function($view){
            $archives_full = \App\Models\Post::archives();
            $archives_sliced = array_slice($archives_full, 0, 10);

            $view->with(compact('archives_full', 'archives_sliced'));
        });

        // View composer for tags
        view()->composer('partials._tags', function($view){
            $tags_sidebar = \App\Models\Tag::withCount('posts')->orderBy('posts_count', 'desc')->orderBy('name')->take(5)->get();

            $view->with(compact('tags_sidebar'));
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
