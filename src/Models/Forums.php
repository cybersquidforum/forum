<?php

namespace Cybersquid\Forum;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Forums extends Model 
{

    protected $table = 'forums';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function category()
    {
        return $this->belongsTo('Category', 'category_id');
    }

    public function threads()
    {
        return $this->hasMany('Thread');
    }

}