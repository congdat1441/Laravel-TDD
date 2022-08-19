<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class ShowTasksTest extends TestCase
{
    /** @test */
    public function user_can_show_tasks()
    {
        $task = Task::factory()->create();
        $response = $this->get(route('tasks.show', $task->id));
        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('tasks.show');
        $response->assertSee($task->name);
    }

    /** @test */
    public function user_can_not_show_tasks_not_exists()
    {
        $taskid = -1;
        $response = $this->get(route('tasks.show', $taskid));
        $response->assertStatus(Response::HTTP_NOT_FOUND);

    }
}
