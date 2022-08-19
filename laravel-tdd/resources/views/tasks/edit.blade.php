@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Task</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>Create task</h2>
                <form action="{{ route('tasks.update', $task->id) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="card">
                        <div class="card-header">
                            <input type="text" class="form-group" name="name" placeholder="Name..." value="{{old('name') ?? $task->name}}">
                            @error('name')
                            <span id="name-error" class="error text-danger" style="display: block;">
                                {{$message}}
                            </span>
                            @enderror
                        </div>
                        <div class="card-body">
                            <input type="text" class="form-group" name="content" placeholder="Content..." value="{{old('content') ?? $task->content}}">
                            @error('content')
                            <span id="name-error" class="error text-danger" style="display: block;">
                                {{$message}}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <button class="btn btn-success">Update </button>
                </form>
            </div>
        </div>
    </div>
@endsection
