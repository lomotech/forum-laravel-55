<?php

namespace App\Http\Controllers;

use App\Thread;
use Illuminate\Http\Request;

class ThreadsController extends controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * display thread listing.
     *
     * @return \illuminate\contracts\view\factory|\illuminate\view\view
     */
    public function index()
    {
        $threads = Thread::latest()->get();

        return view('threads.index', compact('threads'));
    }

    /**
     * display the specific thread.
     *
     * @param thread $thread
     * @return \illuminate\contracts\view\factory|\illuminate\view\view
     */
    public function show(Thread $thread)
    {
        return view('threads.show', compact('thread'));
    }

    /**
     * store a newly created thread in storage.
     *
     * @param request $request
     * @return \illuminate\http\redirectresponse|\illuminate\routing\redirector
     */
    public function store()
    {
        $thread = Thread::create([
            'user_id' => auth()->user()->id,
            'title' => request('title'),
            'body' => request('body'),
        ]);

        return redirect($thread->path());
    }
}
