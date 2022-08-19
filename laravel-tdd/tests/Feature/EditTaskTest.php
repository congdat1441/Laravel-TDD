<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class EditTaskTest extends TestCase
{
    /** @test */
    public function user_can_edit_one_tasks_exists()
    {
        $this->actingAs(User::factory()->create());
        $task = Task::factory()->create();
        $response = $this->get(route('tasks.edit', $task->id));
        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('tasks.edit');
    }
}
