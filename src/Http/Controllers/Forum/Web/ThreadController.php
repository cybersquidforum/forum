<?php

namespace Cybersquids\Forum\Http\Controllers\Forum\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cybersquids\Forum\Models\Forums;
use Cybersquids\Forum\Models\Thread;
use Cache;

class ThreadController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        Cache::forget('forum_threads');
        if (Cache::has('forum_threads')) {
            $threads = Cache::get('forum_threads');
        } else {
            $threads = Thread::all();
            Cache::forever('forum_threads', $threads);
        }

        if (request()->wantsJson()) {
            return $threads;
        }

        return view('web.forum.threads.index', [
            'threads' => $threads,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        //@todo Add create to threads a.k.a topics
    }

    /**
     * Store a newly created resource in storage.
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'forum_id' => 'required',
            'title' => 'required|unique:threads',
            'body' => 'required',
        ]);

        $thread = new Thread;
        $thread->user_id = $request->user_id;
        $thread->forum_id = $request->forum_id;
        $thread->title = $request->title;
        $thread->body = $request->body;

        $thread->save();

        Cache::forget('forum_threads');

        $threads = Thread::all();
        Cache::forever('forum_threads', $threads);
        Cache::forever('forum_thread_'.$thread->id, $thread);

        return redirect()->route('web.forum.threads')->with('success', 'The thread is created successfully');
    }

    /**
     * Display the specified resource.
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        if(Cache::has('forum_thread_'.$id)){
            $thread = Cache::get('forum_thread_'.$id);
        } else {
            $thread = Thread::findOrFail($id);
            Cache::forever('forum_thread_'.$id, $thread);
        }

        return view('web.forum.threads.show', [
            'thread' => $thread,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //@todo Add edit to the thread.
        //@todo Remove old cache and cache it again with the new value.
    }

    /**
     * Update the specified resource in storage.
     * @param  int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'forum_id' => 'required',
            'title' => 'required|unique:threads, title,'.$id,
            'body' => 'required',
        ]);

        $thread = Thread::findOrFail($id);
        $thread->user_id = $request->user_id;
        $thread->forum_id = $request->forum_id;
        $thread->title = $request->title;
        $thread->body = $request->body;

        $thread->update();

        Cache::forget('forum_forums');
        Cache::forget('forum_forums_'.$id);

        $threads = Thread::all();
        Cache::forever('forum_forums', $threads);
        Cache::forever('forum_thread_'.$thread->id, $thread);

        return redirect()->route('web.forum.threads')->with('success', 'The thread is updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $thread = Thread::findOrFail($id);
        $thread->delete();

        Cache::forget('forum_threads');
        Cache::forget('forum_thread_'.$id);

        $threads = Thread::all();
        Cache::forever('forum_threads', $threads);

        if (request()->wantsJson()) {
            return $threads;
        }

        return redirect()->route('web.forum.threads')->with('success', 'The thread is deleted successfully');
    }
}
