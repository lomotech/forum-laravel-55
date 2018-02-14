<?php

namespace App\Http\Controllers;

use App\Thread;
use Illuminate\Http\Request;

class ThreadsController extends controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
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
     * @param Thread $thread
     * @return \illuminate\contracts\view\factory|\illuminate\view\view
     */
    public function show($channelId, Thread $thread)
    {
        return view('threads.show', compact('thread'));
    }

    public function create()
    {
        return view('threads.create');
    }

    /**
     * store a newly created thread in storage.
     *
     * @param Request $request
     * @return \illuminate\http\redirectresponse|\illuminate\routing\redirector
     */
    public function store(Request $request)
    {
        $thread = Thread::create([
            'user_id' => auth()->user()->id,
            'channel_id' => request('channel_id'),
            'title' => request('title'),
            'body' => request('body'),
        ]);

        return redirect($thread->path());
    }
}
