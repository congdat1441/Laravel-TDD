@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>Create task</h2>
                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <input type="text" class="form-group" name="name" placeholder="Name...">
                            @error('name')
                            <span id="name-error" class="error text-danger" style="display: block;">
                                {{$message}}
                            </span>
                            @enderror
                        </div>
                        <div class="card-body">
                            @error('name')
                            <span id="name-error" class="error text-danger" style="display: block;">
                                {{$message}}
                            </span>
                            @enderror
                            <input type="text" class="form-group" name="content" placeholder="Content...">
                        </div>
                    </div>

                    <button class="btn btn-success">Submit </button>
                </form>
            </div>
        </div>
    </div>
@endsection
