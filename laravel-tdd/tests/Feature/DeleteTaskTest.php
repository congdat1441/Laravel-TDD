<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class DeleteTaskTest extends TestCase
{
    /** @test */
    public function authenticated_user_can_delete_taks()
    {
        $this->actingAs(User::factory()->create());
        $task = Task::factory()->create();
        $response = $this->delete(route('tasks.destroy', $task->id));
        $this->assertDatabaseMissing('tasks', $task->toArray());
        $response->assertRedirect(route('tasks.index'));
    }

    /** @test */
    public function unauthenticated_user_can_not_delete_task()
    {
        $task = Task::factory()->create();
        $response = $this->delete(route('tasks.destroy', $task->id));
        $response->assertRedirect('/login');
    }
}
