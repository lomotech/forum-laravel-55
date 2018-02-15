@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ $thread->title }}
                        <br>
                        <small>by <a href="#">{{$thread->creator->name}}</a>
                            | {{ $thread->created_at->diffForHumans() }}</small>
                    </div>
                    <div class="panel-body">{{ $thread->body }}</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @foreach ($thread->replies as $reply)
                    @include('threads.reply')
                @endforeach
            </div>
        </div>

        @if(auth()->check())
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <form action="{{ route('threads.replies.store', ['channel' => $thread->channel->slug, 'thread' => $thread->id]) }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <textarea name="body" id="body" cols="30" rows="5" class="form-control"
                                      placeholder="What in your mind?"></textarea>
                        </div>
                        <button class="btn btn-default" type="submit">Post!</button>
                    </form>
                </div>
            </div>
        @else
            <p class="text-center">Please <a href="{{ route('login') }}">sign in</a> to participate in this thread.</p>
        @endif
    </div>
@endsection
