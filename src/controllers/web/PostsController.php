<?php namespace Cybersquid\Forum\Controllers\Web;

use Cybersquid\Forum\Controllers\BaseController;
use Cybersquid\Forum\Models\Post;
use Illuminate\Http\Request;

class PostsController extends BaseController
{

    public function __construct(Request $request)
    {
        $this->model = Post::class;
        parent::__construct();
        $this->policy = 'posts.';
    }
}