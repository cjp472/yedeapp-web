<?php

namespace App\Models;

class Topic extends Model
{
    protected $fillable = [
        'title', 'body', 'user_id', 'chapter_id', 'course_id', 'comment_count', 'view_count', 'order', 'free', 'desc', 'slug'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function link($courseslug = '')
    {
        // Provide a $courseslug param in avoiding query database multi times.
        if (!$courseslug) {
            $courseslug = $this->course->slug;
        }

        // Inject parameters according to the topic.show route's order
        return route('topic.show', [$courseslug, $this->id, $this->slug]);
    }
}
