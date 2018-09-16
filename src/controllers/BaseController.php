<?php namespace Cybersquid\Forum\Controllers;

use App\Http\Controllers\Controller;
use CustomRequest;
use CustomResponse;
use CustomModel;

class BaseController extends Controller
{
    public $list_view, $form_view, $model, $policy;
    public $response = 'Cybersquid\Forum\Responses\BaseResponse';
    public $request = 'Cybersquid\Forum\Requests\BaseRequest';
    public $data = [];

    public function __construct()
    {
        class_alias($this->request, 'CustomRequest');
        class_alias($this->response, 'CustomResponse');
        class_alias($this->model, 'CustomModel');
    }

    public function list(CustomRequest $request)
    {

        $this->model = new $this->model;
        if ($request->has('with')) {
            $this->model = $this->model->with($request->get('with'));
        }
        if ($request->has('appends')) {
            $this->model->setAppends($request->get('appends'));
        }
        if ($request->has('fields')) {
            $this->model = $this->model->select($request->get('fields'));
        }
        if ($request->has('filter')) {
            $this->model = $this->model->where($request->get('filter'));
        }
        if ($request->wantsJson()) {
            $this->data = $this->model->simplePaginate($request->get('limit', 20));

            return $this->response()->json();
        }
        $this->data['items'] = $this->model->paginate($request->get('limit', 20));

        return $this->response()->view($this->list_view);
    }

    public function response()
    {
        return new CustomResponse($this->data);
    }

    public function get(CustomRequest $request, CustomModel $item)
    {
        if ($this->policy) {
            $this->authorize($this->policy . 'view', $item);
        }
        if ($request->has('with')) {
            $item->loadMissing($request->get('with'));
        }

        if ($request->has('appends')) {
            $item->setAppends($request->get('appends'));
        }
        if ($request->has('fields')) {
            $item = $item->only($request->get('fields'));
        }
        $this->data['item'] = $item;
        if ($request->wantsJson()) {
            return $this->response()->json();
        }

        return $this->response()->view($this->form_view);
    }

    public function post(CustomRequest $request, ?CustomModel $item)
    {
        try {
            if (!$item) {
                if ($this->policy) {
                    $this->authorize($this->policy . 'create', CustomModel::class);
                }
                $item = new CustomModel();
            }
            if ($this->policy) {
                $this->authorize($this->policy . 'update', $item);
            }
            $item->autoFill($request);

            foreach ($request->all() as $key => $relation) {

                if (in_array($key, $item->getRelationships())) {
                    $rel_data = [];
                    foreach ($relation as $data) {
                        $rel_data[array_keys($data)[0]] = array_values($data)[0];
                    }
                    $item->{$key}()->sync($rel_data);
                }
            }
        } catch (\Exception $e) {
            if ($request->wantsJson()) {
                return response()->json($e);
            }

            return $this->response()->redirect()->back()->withInput()->withException($e);
        }
        if ($request->wantsJson()) {
            $this->data['item'] = $item;

            return $this->response()->json($this->data);
        }

        return $this->response()->redirect()->back()->with('message', 'Item Saved');
    }

    public function delete(CustomRequest $request, CustomModel $item)
    {
        if ($this->policy) {
            $this->authorize($this->policy . 'delete', $item);
        }
        try {
            $item->delete();
        } catch (\Exception $e) {
            if ($request->wantsJson()) {
                return response()->json($e);
            }

            return $this->response()->redirect()->back()->withInput()->withException($e);
        }
        if ($request->wantsJson()) {
            $this->data = ['message' => 'Item Removed'];

            return $this->response()->json();
        }

        return $this->response()->redirect()->back()->with('message', 'Item Removed');
    }

    public function getRelation(CustomRequest $request, CustomModel $item, $relation)
    {
        if (in_array($relation, $item->getRelationships())) {
            return response()->json($item->{$relation});
        }

        throw new \Exception('Relation "' . $relation . '" not found in ' . $item->reflection()->getName(), 400);
    }
}