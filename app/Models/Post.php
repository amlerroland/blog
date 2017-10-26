<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\{User, Tag};

class Post extends Model
{
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
    
}
