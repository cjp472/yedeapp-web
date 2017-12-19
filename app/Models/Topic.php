<?php

namespace App\Models;

class Topic extends Model
{
    protected $fillable = [
        'title', 'body', 'user_id', 'chapter_id', 'book_id', 'comment_count', 'view_count', 'order', 'desc', 'slug'
    ];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
