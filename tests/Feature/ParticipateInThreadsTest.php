<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ParticipateInThreadsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function a_guest_user_may_not_add_replies()
    {
        // given we have an unauthenticated user
        // and an existing thread
        // when the user adds a reply to the thread
        // we expect an exception
        $this->withExceptionHandling()
            ->post('threads/1/replies', [])
            ->assertRedirect(route('login'));
    }

    /** @test */
    function an_authenticated_user_may_participate_in_forum_threads()
    {
        $this->be($user = factory('App\User')->create());

        $thread = factory('App\Thread')->create();
        $reply = factory('App\Reply')->create();

        $this->post(route('threads.replies.store', $thread->id), $reply->toArray());

        $this->get($thread->path())
            ->assertSee($reply->body);
    }
}
