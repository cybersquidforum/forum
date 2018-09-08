<?php

namespace Cybersquid\Forum;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Thread extends Model 
{

    protected $table = 'threads';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function forum()
    {
        return $this->belongsTo('Forums', 'forum_id');
    }

    public function owner()
    {
        return $this->belongsTo('User', 'user_id');
    }

}