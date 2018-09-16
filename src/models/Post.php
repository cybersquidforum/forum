<?php

namespace Cybersquid\Forum\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{

    public $timestamps = true;
    protected $table = 'posts';

    use SoftDeletes;
    protected $dates = ['deleted_at', 'locked_at', 'pinned_at', 'locked_at', 'sticky_at'];
    protected $casts = [
        'replies_count' => 'integer',
        'visits'        => 'integer',
    ];

    protected $fillable = [
        'user_id',
        'forum_id',
        'thread_id',
        'title',
        'content',
        'replies_count',
        'visits',
        'locked_at',
        'pinned_at',
        'locked_at',
        'sticky_at',
        'redirect_to',
    ];

    public function forum()
    {
        return $this->belongsTo(Forum::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}