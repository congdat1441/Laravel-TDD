@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <table class="table table-striped">
                <tr>
                    <th>ID</th>
                    <th>name</th>
                    <th>Content</th>
                    <th>Actions</th>
                </tr>
                @foreach($tasks as $task)
                    <tr>
                        <td>{{$task->id}}</td>
                        <td>{{$task->name}}</td>
                        <td>{{$task->content}}</td>
                        <td>
                            <a href="{{route('tasks.show', $task->id)}}" class="btn btn-primary">Show</a>
                            <a href="{{route('tasks.edit', $task->id)}}" class="btn btn-warning">Edit</a>
                            <form method="POST" action="{{route('tasks.destroy', $task->id)}}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
            {{$tasks->links()}}
        </div>
    </div>
@endsection
