<?php

namespace Cybersquid\Forum\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Forum extends Model
{

    public $timestamps = true;
    protected $table = 'forums';

    use SoftDeletes;
    protected $dates = ['deleted_at', 'locked_at'];

    protected $casts = [
        'position'      => 'integer',
        'replies_count' => 'integer',
        'threads_count' => 'integer',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function threads()
    {
        return $this->hasMany(Post::class);
    }

}