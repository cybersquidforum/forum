<?php

namespace Cybersquid\Forum\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{

    public $user = null;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public function __construct(
        array $query = [],
        array $request = [],
        array $attributes = [],
        array $cookies = [],
        array $files = [],
        array $server = [],
        $content = null
    ) {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
        $this->user = request()->user();
    }

    public function authorize()
    {
        return $this->{'can' . ucfirst($this->method())}();
    }

    public function getRules()
    {
        return [];
    }

    public function putRules()
    {
        return $this->postRules();
    }

    public function postRules()
    {
        return [];
    }

    public function deleteRules()
    {
        return [];
    }

    public function canPost()
    {
        return true;
    }

    public function canGet()
    {
        return true;
    }

    public function canPut()
    {
        return true;
    }

    public function canDelete()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->{$this->method() . 'Rules'}();
    }
}
