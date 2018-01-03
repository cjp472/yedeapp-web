<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'password', 'introduction', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function isAuthorOf($model)
    {
        return $this->id == $model->user_id;
    }

    /**
     * Mutate user model's password attribute before saved into db.
     *
     * @param  string
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        // If value's length equal to 60, it has been bcrypted.
        if (strlen($value) != 60) {
            $value = bcrypt($value);
        }

        $this->attributes['password'] = $value;
    }

    /**
     * Mutate user model's avatar attribute before saved into db.
     *
     * @param  string
     * @return void
     */
    public function setAvatarAttribute($path)
    {
        // If the path isn't started with the "http" prefix,
        // It must come from xa(admin), fixs this URL.
        if (!starts_with($path, 'http')) {
            $path = config('app.url') . '/uploads/images/avatars/' . $path;
        }

        $this->attributes['avatar'] = $path;
    }


}
