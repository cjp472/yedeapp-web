<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = ['user_id'];

    public function topics()
    {
        return $this->morphedByMany(Topic::class, 'votable');
    }

    public function comments()
    {
        return $this->morphedByMany(Comment::class, 'votable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}