<?php

namespace Cybersquid\Forum\Http\Controllers\Forum\Web;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Cybersquid\Forum\Models\Category;
use Cache;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        if (Cache::has('forum_categories')) {
            $categories = Cache::get('forum_categories');
        } else {
            $categories = Category::orderBy('position', 'asc')->get();
            Cache::forever('forum_categories', $categories);
        }

        if (request()->wantsJson()) {
            return $categories;
        }

        return view('web.forum.categories.index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('web.forum.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories',
            'description' => 'nullable',
        ]);

        $category = new Category;
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        Cache::forget('forum_categories');

        $categories = Category::all();
        Cache::forever('forum_categories', $categories);
        Cache::forever('forum_category_'.$category->id, $category);

        return redirect()->route('web.forum.category')->with('success', 'The category is created successfully');
    }

    /**
     * Display the specified resource.
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        if(Cache::has('forum_category_'.$id)){
            $category = Cache::get('forum_category_'.$id);
        } else {
            $category = Category::findOrFail($id);
            Cache::forever('forum_category_'.$id, $category);
        }

        return view('web.forum.category.show', [
            'category' => $category,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        if(Cache::has('forum_category_'.$id)){
            $category = Cache::get('forum_category_'.$id);
        } else {
            $category = Category::findOrFail($id);
            Cache::forever('forum_category_'.$category->id, $category);
        }

        return view('web.forum.category.edit', [
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param  int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories, name,' . $id,
            'description' => 'nullable',
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->description = $request->description;
        $category->update();

        Cache::forget('forum_categories');
        Cache::forget('forum_category_'.$id);

        $categories = Category::all();
        Cache::forever('forum_categories', $categories);
        Cache::forever('forum_category_'.$category->id, $category);

        return redirect()->route('web.forum.category')->with('success', 'The category is created successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        Cache::forget('forum_categories');
        Cache::forget('forum_category_'.$id);

        $categories = Category::all();
        Cache::forever('forum_categories', $categories);

        if (request()->wantsJson()) {
            return $category;
        }

        return redirect()->route('web.forum.category')->with('success', 'The category is deleted successfully');
    }
}
