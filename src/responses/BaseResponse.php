<?php namespace Cybersquid\Forum\Responses;

use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class BaseResponse extends Response
{

    public $data = [];

    public function __construct($data = [])
    {
        parent::__construct();
        $this->data = $data;

        return $this;
    }

    public function view($view)
    {
        return view($view, $this->data);
    }

    public function json()
    {
        return response()->json($this->data);
    }

    public function transform()
    {
//        $this->data = (new Collection($this->data))->transform(function($item){
//            return $item;
//        })->toArray();
        return $this;
    }

    public function redirect()
    {
        return redirect();
    }
}