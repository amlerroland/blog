<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Tag extends Model
{
    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        // During the creation of a tag populate the slug field
        \App\Models\Tag::creating(function($tag){
            $tag->slug = str_slug($tag->name);
        });
    }
    
    /**
     * Relationships
     */
    
    public function posts()
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }
}
