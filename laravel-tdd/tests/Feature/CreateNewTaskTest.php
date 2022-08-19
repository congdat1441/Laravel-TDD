<?php

namespace Tests\Feature;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class CreateNewTaskTest extends TestCase
{
    /** @test */ //co the luu khi da dang nhap
    public function authenticated_user_can_new_task()
    {
        $this->actingAs(User::factory()->create());
        $task= Task::factory()->make()->toArray();
        $response = $this->post($this->getCreateTaskRoute(), $task);

        $response->assertStatus(302);
        $this->assertDatabaseHas('tasks', $task);
        $response->assertRedirect(route('tasks.index'));
    }

    /** @test *///khong the luu khi khong dang nhap
    public function unauthenticated_user_can_not_create_task()
    {
        $task= Task::factory()->make()->toArray();
        $response = $this->post($this->getCreateTaskRoute(), $task);
        $response->assertRedirect('/login');
    }

    /** @test */ //da dang nhap, khong the luu khi truong name null
    public function authenticated_user_can_not_create_task_if_name_field_is_null()
    {
        $this->actingAs(User::factory()->create());
        $task = Task::factory()->make(['name' => null])->toArray();
        $response= $this->post($this->getCreateTaskRoute(), $task);
        $response->assertSessionHasErrors(['name']);
    }

    /** @test */ // da dang nhap, co the xem view tao task
    public function authenticated_user_can_view_create_task_form()
    {
        $this->actingAs(User::factory()->create());
        $response = $this->get($this->getCreateTaskViewRoute());
        $response->assertViewIs('tasks.create');
    }

    /** @test */ // da dang nhap, co the xem thong bao loi truong name
    public function authenticated_user_can_see_name_required_text_if_validation_errors()
    {
        $this->actingAs(User::factory()->create());
        $task = Task::factory()->make(['name'=>null])->toArray();
        $response = $this->from($this->getCreateTaskRoute())->post($this->getCreateTaskRoute(), $task);
        $response->assertRedirect($this->getCreateTaskRoute());
    }

    /** @test */ // khong dang nhap, khong the xem view tao
    public function unauthenticated_user_can_not_see_create_task_form_view()
    {
        $response = $this->get($this->getCreateTaskViewRoute());
        $response->assertRedirect('/login');
    }

    public function getCreateTaskViewRoute()
    {
        return route('tasks.create');
    }

    public function     getCreateTaskRoute()
    {
        return route('tasks.store');
    }
}
