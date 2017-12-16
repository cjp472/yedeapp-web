<?php

namespace App\Models;

class Topic extends Model
{
    protected $fillable = ['title', 'body', 'user_id', 'chapter_id', 'book_id', 'comment_count', 'view_count', 'order', 'desc', 'slug'];
}
