<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class  TaskController extends Controller
{
    protected  $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function index()
    {
        $tasks = $this->task->latest('id')->paginate(10);
        return view('tasks.index', compact('tasks'));
    }

    public function store(CreateTaskRequest $request)
    {
        $this->task->create($request->all());
        return redirect()->route('tasks.index');
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function destroy($id)
    {
        $task = $this->task->findorfail($id);
        $task->destroy($id);
        return redirect()->route('tasks.index');
    }

    public function edit($id)
    {
        $task = Task::findorfail($id);
        return view('tasks.edit', compact('task'));
    }

    public function update(UpdateTaskRequest $request, $id)
    {
        $task = Task::findorfail($id);
        $task->update($request->all());
        return redirect()->route('tasks.index')->with(['message'=>'update Success']);
    }

    public function show($id)
    {
        $task = Task::findorfail($id);
        return view('tasks.show', compact('task'));
    }
}
