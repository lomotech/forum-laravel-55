<?php

namespace App\Http\Controllers;

use App\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RepliesController extends Controller
{

    /**
     * RepliesController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth')->only('store');;
    }

    /**
     * Persist a new reply.
     *
     * @param Thread $thread
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Thread $thread)
    {
        $thread->addReply([
            'body' => request('body'),
            'user_id' => Auth::user()->id,
        ]);

        return back();
    }
}
