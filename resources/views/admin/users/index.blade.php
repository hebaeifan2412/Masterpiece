
@extends('admin.layout.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0 fw-bold text-dark">Users Management</h2>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i> Add New User
        </a>
    </div>

    <!-- Search and Filter -->
    <form method="GET" action="{{ route('admin.users.index') }}" class="row g-3 mb-4">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Search by name or email..." value="{{ request('search') }}">
        </div>
        <div class="col-md-4">
            <select name="role" class="form-select" onchange="this.form.submit()">
                <option value="">All Roles</option>
                @foreach($roles as $role)
                    <option value="{{ $role->name }}" {{ request('role') == $role->name ? 'selected' : '' }}>
                        {{ ucfirst($role->name) }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">
                <i class="fas fa-filter me-1"></i> Apply
            </button>
        </div>
        <div class="col-md-2">
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary w-100">
                <i class="fas fa-sync-alt me-1"></i> Reset
            </a>
        </div>
    </form>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">#</th>
                            <th>Profile</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $index => $user)
                        <tr>
                            <td class="ps-4 fw-medium">{{ $index + 1 }}</td>
                            <td>
                                <div class="avatar-sm">
                                    @if($user->image)
                                        <img src="{{ asset('storage/users/' . $user->image) }}" class="rounded-circle w-100 h-100 object-fit-cover">
                                    @else
                                        <img src="{{ asset('storage/users/default.png') }}" class="rounded-circle w-100 h-100 object-fit-cover">
                                    @endif
                                </div>
                            </td>
                            <td>{{ $user->firstname }} {{ $user->secname }} {{ $user->thirdname }} {{ $user->lastname }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone_no }}</td>
                            <td>
                                <span class="badge bg-{{ $user->role->name == 'admin' ? 'primary' : 'info' }}-soft text-{{ $user->role->name == 'admin' ? 'primary' : 'secondary' }}">
                                    {{ ucfirst($user->role->name) }}
                                </span>
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    {{-- <a href="{{ route('admin.users.edit', $user->id) }}" 
                                       class="btn btn-sm btn-warning-soft text-warning rounded-circle"
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a> --}}
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-danger-soft text-danger rounded-circle"
                                                title="Delete"
                                                onclick="return confirm('Are you sure you want to delete this user?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                <i class="fas fa-users fa-2x mb-3"></i>
                                <p class="mb-0">No users found.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
