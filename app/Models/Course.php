<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'name', 'slug', 'user_id', 'cover', 'price', 'intro', 'introduction', 'chapters'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
