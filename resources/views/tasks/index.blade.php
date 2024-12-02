@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Task List</h1>
    
    <form action="{{ route('tasks.index') }}" method="GET" class="mb-3">
        <input type="text" name="search" placeholder="Search by title" class="form-control" value="{{ request('search') }}">
        <button type="submit" class="btn btn-secondary mt-2">Search</button>
    </form>

    <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Add Task</a>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tasks as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ $task->status }}</td>
                    <td>
                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No tasks found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    {{ $tasks->links() }} <!-- Pagination links -->
</div>
@endsection