<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Carbon\Carbon;
use App\Models\{User, Tag};

class Post extends Model
{
    // protected $with = ['user'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Set up morphmap, onupdate, oncreate
     */
    
    protected static function boot()
    {
        parent::boot();

        // Create custom polymorphic types
        Relation::morphMap([
            'post' => Post::class,
        ]);

        // After creation of a post populate the slug from the date and title
        static::created(function($post){
            $post->slug = str_slug($post->created_at . '-' . $post->title);
            $post->update();
        });

        // During post update, update the the title and the stripped body as well
        static::updating(function($post){
            $post->slug = str_slug($post->created_at . '-' . $post->title);
            $post->body_stripped = strip_tags($post->body);
        });

        // During the creation of a post populate the stripped body field
        static::creating(function($post){
            $post->body_stripped = strip_tags($post->body);
        });
    }

    /**
     * Relationships
     */
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    /**
     * Functions
     */
    
    public function scopeFilter($query, $filters)
    {
        if (isset($filters['month']) && $month = $filters['month']) {
            $query->whereMonth('created_at', Carbon::parse($month)->month);
        }

        if (isset($filters['year']) && $year = $filters['year']) {
            $query->whereYear('created_at', $year);
        }

    }

    public static function archives()
    {
        return static::selectRaw('year(created_at) year, monthname(created_at) month, count(*) published')
            ->groupBy('year', 'month')
            ->orderByRaw('min(created_at) desc')
            ->get()
            ->toArray();
    }

    public function ownedByUser($user)
    {
        if ($user) {
            return $this->user->id === $user->id;
        }

        return false;
    }
}
