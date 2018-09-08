<?php

namespace Cybersquids\Forum\Http\Controllers\Forum\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cybersquids\Forum\Models\Category;
use Cybersquids\Forum\Models\Forums;
use Cache;

class ForumsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        Cache::forget('forum_forums');
        if (Cache::has('forum_forums')) {
            $forums = Cache::get('forum_forums');
        } else {
            $forums = Forums::orderBy('position', 'asc')->get();
            Cache::forever('forum_forums', $forums);
        }

        if (request()->wantsJson()) {
            return $forums;
        }

        return view('web.forum.forums.index', [
            'forums' => $forums,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        if (Cache::has('forum_categories')) {
            $categories = Cache::get('forum_categories');
        } else {
            $categories = Category::orderBy('position', 'asc')->get();
            Cache::forever('forum_categories', $categories);
        }

        return view('web.forum.forums.create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:forums',
            'description' => 'nullable',
            'icon' => 'required',
            'category_id' => 'required',
        ]);

        $forum = new Forums;
        $forum->name = $request->name;
        $forum->description = $request->description;
        $forum->icon = $request->icon;
        $forum->category_id = $request->category_id;
        $forum->save();

        Cache::forget('forum_forums');

        $forums = Forums::all();
        Cache::forever('forum_forums', $forums);
        Cache::forever('forum_forums_' . $forum->id, $forum);

        return redirect()->route('web.forum.forums')->with('success', 'The forum is created successfully');
    }

    /**
     * Display the specified resource.
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        if (Cache::has('forum_forums_' . $id)) {
            $forum = Cache::get('forum_forums_' . $id);
        } else {
            $forum = Forums::findOrFail($id);
            Cache::forever('forum_forums_' . $id, $forum);
        }

        return view('web.forum.forums.show', [
            'forum' => $forum,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        if (Cache::has('forum_forums_' . $id)) {
            $forum = Cache::get('forum_forums_' . $id);
        } else {
            $forum = Forums::findOrFail($id);
            Cache::forever('forum_forums_' . $forum->id, $forum);
        }

        if (Cache::has('forum_categories')) {
            $categories = Cache::get('forum_categories');
        } else {
            $categories = Category::orderBy('position', 'asc')->get();
            Cache::forever('forum_categories', $categories);
        }

        return view('web.forum.forums.edit', [
            'forum' => $forum,
            'categories' => $categories,
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
            'name' => 'required|unique:forums, name,' . $id,
            'category_id' => 'required',
            'description' => 'nullable',
            'icon' => 'required',
        ]);

        $forum = Forums::findOrFail($id);
        $forum->name = $request->name;
        $forum->description = $request->description;
        $forum->icon = $request->icon;
        $forum->category_id = $request->category_id;
        $forum->update();

        Cache::forget('forum_forums');
        Cache::forget('forum_forums_' . $id);

        $forums = Forums::all();
        Cache::forever('forum_forums', $forums);
        Cache::forever('forum_forums_' . $forum->id, $forum);

        return redirect()->route('web.forum.forums')->with('success', 'The forum is updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $forum = Forums::findOrFail($id);
        $forum->delete();

        Cache::forget('forum_forums');
        Cache::forget('forum_forums_' . $id);

        $forums = Forums::all();
        Cache::forever('forum_forums', $forums);

        if (request()->wantsJson()) {
            return $forum;
        }

        return redirect()->route('web.forum.forums')->with('success', 'The forum is deleted successfully');
    }
}
