<?php

namespace Cybersquid\Forum\Models;

class User extends \App\User
{
    protected $dates = ['deleted_at', 'email_confirmed_at', 'banned_until', 'last_seen'];
    protected $fillable = [
        'name',
        'username',
        'email',
        'language',
        'password',
        'reputation',
        'email_confirmed_at',
        'banned_until',
        'last_seen',
        'level',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

}