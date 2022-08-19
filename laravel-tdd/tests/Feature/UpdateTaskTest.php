<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class UpdateTaskTest extends TestCase
{
    /** @test */ // co the update khi da dang nhap
    public function authenticated_user_can_update_tasks_into_database()
    {
        $this->actingAs(User::factory()->create());
        $task = Task::factory()->make()->toArray();
        $taskold = Task::factory()->create();

        $response = $this->put(route('tasks.update', $taskold->id), $task);
        $response->assertStatus(302);
        $this->assertDatabaseHas('tasks', [
            'id' => $taskold ->id,
            'name' =>$task['name'],
            'content' =>$task['content'],
        ]);
        $response->assertRedirect(route('tasks.index'));
    }

    /** @test */ // co the xem view edit khi da dang nhap
    public function authenticated_user_can_show_tasks_to_edit()
    {
        $this->actingAs(User::factory()->create());
        $task = Task::factory()->create();
        $response = $this->get(route('tasks.show', $task->id));
        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('tasks.show');
    }

    /** @test */ //khong the xem view edit khi khong dang nhap
    public function unauthenticated_user_can_not_show_tasks_to_edit()
    {
        $task = Task::factory()->create();
        $response = $this->get(route('tasks.show', $task->id));
        $response->assertRedirect('/login');
    }

    /** @test*/ //thong bao loi khi name null
    public function authenticated_user_can_not_update_when_name_null()
    {
        $this->actingAs(User::factory()->create());
        $taskold = Task::factory()->create();
        $task = Task::factory()->make(['name' => null])->toArray();
        $response = $this->put(route('tasks.update', $taskold->id), $task);
        $response->assertSessionHasErrors(['name']);
    }
    /** @test*/ //thong bao loi khi content null
    public function authenticated_user_can_not_update_when_content_null()
    {
        $this->actingAs(User::factory()->create());
        $taskold = Task::factory()->create();
        $task = Task::factory()->make(['content' => null])->toArray();
        $response = $this->put(route('tasks.update', $taskold->id), $task);
        $response->assertSessionHasErrors(['content']);
    }

    /** @test*/ //thong bao loi khi ca hai null
    public function authenticated_user_can_not_update_when_all_null()
    {
        $this->actingAs(User::factory()->create());
        $taskold = Task::factory()->create();
        $task = Task::factory()->make(['name' => null, 'content' =>null])->toArray();
        $response = $this->put(route('tasks.update', $taskold->id), $task);
        $response->assertSessionHasErrors(['name'], ['content']);
    }
}
