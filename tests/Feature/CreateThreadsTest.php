<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function a_guest_may_not_see_create_threads_page()
    {
        $this->withExceptionHandling();

        // we have a guest that want to store new thread
        // but will redirect to login page
        $this->post(route('threads.store'))
            ->assertRedirect(route('login'));

        // we have a guest that want to create thread
        // but will redirect to login page
        $this->get(route('threads.create'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    function an_authenticated_user_can_create_new_forum_threads()
    {
        // Given we have a signed user
        $this->signIn();

        // when we hit the endpoint to create a new thread
        $thread = create('App\Thread');

        $this->post('/threads', $thread->toArray());
//        $this->post(route('threads.store'), $thread->toArray());

        // then, when we visit the thread page
        // we should see the new thread
//        dd('/threads/'.$thread->channel->slug.'/'. $thread->id);
        $this->get('/threads/'.$thread->channel->slug.'/'. $thread->id)
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }
}
