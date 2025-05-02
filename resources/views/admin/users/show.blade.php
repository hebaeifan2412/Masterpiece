@extends('admin.layout.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-primary text-white">
            <h4>User Details</h4>
        </div>
        <div class="card-body">
            <p><strong>Username:</strong> {{ $user->username }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Phone Number:</strong> {{ $user->phone_no }}</p>
            <p><strong>Role:</strong> {{ $user->role->name }}</p>
            <p><strong>Status:</strong> {{ ucfirst($user->status) }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</div>
@endsection
