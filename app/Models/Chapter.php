<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $fillable = ['title', 'desc'];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }
}
