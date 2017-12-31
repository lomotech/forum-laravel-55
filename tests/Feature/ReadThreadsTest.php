<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

/**
 * @property mixed thread
 */
class ReadThreadsTest extends TestCase
{
    use DatabaseMigrations;

    protected $thread;

    /** setUp */
    public function setUp()
    {
        parent::setUp();

        $this->thread = create('App\Thread');
    }

    /** @test */
    public function an_authenticated_user_can_view_all_threads()
    {
        // Given we have a signed user
        $this->signIn();

        $this->get('/threads')
            ->assertSee($this->thread->title);
    }

    /** @test */
    public function an_authenticated_user_can_read_a_single_thread()
    {
        // Given we have a signed user
        $this->signIn();

        $this->get($this->thread->path())
            ->assertSee($this->thread->title);
    }

    /** @test */
    public function an_authenticated_user_can_show_single_thread()
    {
        // Given we have a signed user
        $this->signIn();

        $this->get($this->thread->path())
            ->assertSee($this->thread->title);
    }

    /** @test */
    public function an_authenticated_user_can_read_replies_that_are_associated_with_a_thread()
    {
        // Given we have a signed user
        $this->signIn();

        $reply = create('App\Reply', ['thread_id' => $this->thread->id]);

        $this->get($this->thread->path())
            ->assertSee($reply->body);
    }
}
