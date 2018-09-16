<?php namespace Cybersquid\Forum\Controllers\Web;

use Cybersquid\Forum\Controllers\BaseController;
use Cybersquid\Forum\Models\Forum;
use Illuminate\Http\Request;

class ForumsController extends BaseController
{

    public function __construct(Request $request)
    {
        $this->model = Forum::class;
        parent::__construct();
        $this->policy = 'forum.';
    }
}