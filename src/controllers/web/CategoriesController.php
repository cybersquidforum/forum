<?php namespace Cybersquid\Forum\Controllers\Web;

use Cybersquid\Forum\Controllers\BaseController;
use Cybersquid\Forum\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends BaseController
{

    public function __construct(Request $request)
    {
        $this->model = Category::class;
        parent::__construct();
        $this->policy = 'categories.';
    }
}