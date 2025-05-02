@extends('admin.layout.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0 rounded-4 p-5">
        <h2 class="text-center text-primary mb-4">Edit User</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group mb-4">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" value="{{ old('username', $user->username) }}" class="form-control" id="username" required>
            </div>

            <div class="form-group mb-4">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" id="email" required>
            </div>

            <div class="form-group mb-4">
                <label for="phone_no" class="form-label">Phone Number</label>
                <input type="text" name="phone_no" value="{{ old('phone_no', $user->phone_no) }}" class="form-control" id="phone_no">
            </div>

            <div class="form-group mb-4">
                <label for="password" class="form-label">Password (leave blank to keep current)</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>

            <div class="form-group mb-4">
                <label for="role_id" class="form-label">Role</label>
                <select name="role_id" id="role_id" class="form-control" required>
                    <option value="">Select Role</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-4">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="active" {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-warning btn-lg">Update User</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-lg">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
