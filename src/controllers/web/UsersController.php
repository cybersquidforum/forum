<?php namespace Cybersquid\Forum\Controllers\Web;

use Cybersquid\Forum\Controllers\BaseController;
use Cybersquid\Forum\Models\User;
use Illuminate\Http\Request;

class UsersController extends BaseController
{

    public function __construct(Request $request)
    {
        $this->model = User::class;
        parent::__construct();
        $this->policy = 'users.';
    }
}