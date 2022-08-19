<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class StoreTaskTest extends TestCase
{
    /** @test*/ //co the luu khi dang nhap thanh cong
    public function authenticated_user_can_store_when_log_in_succeed()
    {
        $this->actingAs(User::factory()->create());
        $task = Task::factory()->make();
        $response = $this->post(route('tasks.store'), $task->toArray());
        $this->assertDatabaseHas('tasks', $task->toArray());
        $response->assertRedirect(route('tasks.index'));
    }

    /** @test*/ // khong the luu khi khong dang nhap
    public function unauthenticated_user_can_not_store_when_log_out()
    {
        $task = Task::factory()->create()->toArray();
        $response = $this->post(route('tasks.store'), $task);
        $response->assertRedirect('/login');
    }

    /** @test*/ // khong the luu khi name null
    public function authenticated_can_not_store_when_name_null()
    {
        $this->actingAs(User::factory()->create());
        $task = Task::factory()->make(['name'=>null])->toArray();
        $response = $this->post(route('tasks.store'), $task);
        $response->assertSessionHasErrors('name');
    }
    /** @test*/ //khong the luu khi ca hai null
    public function authenticated_can_not_store_when_all_null()
    {
        $this->actingAs(User::factory()->create());
        $task = Task::factory()->make(['name'=>null, 'content'=>null])->toArray();
        $response = $this->post(route('tasks.store'), $task);
        $response->assertSessionHasErrors('name', 'content');
    }
}
