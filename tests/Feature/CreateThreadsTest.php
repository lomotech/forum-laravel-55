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
        // we have a guest that want to create thread
        // but will redirect to login page
        $this->withExceptionHandling()
            ->get(route('threads.create'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    function a_guest_may_not_store_threads()
    {
        // we have a guest that want to store new thread
        // but will redirect to login page
        $thread = make('App\Thread');
        $this->withExceptionHandling()
            ->post(route('threads.store'), $thread->toArray())
            ->assertRedirect(route('login'));
    }

    /** @test */
    function an_authenticated_user_can_create_new_forum_threads()
    {
        // Given we have a signed user
        $this->signIn();

        // when we hit the endpoint to create a new thread
        $thread = make('App\Thread');

        $this->post(route('threads.store'), $thread->toArray());

        // then, when we visit the thread page
        // we should see the new thread
        $this->get($thread->path())
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }
}
