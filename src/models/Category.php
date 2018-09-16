<?php

namespace Cybersquid\Forum\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model 
{

    public $timestamps = true;
    protected $table = 'categories';

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $casts = [
        'position' => 'integer',
    ];
    protected $fillable = ['name', 'description', 'position'];

    public function forums()
    {
        return $this->hasMany(Forum::class);
    }

}