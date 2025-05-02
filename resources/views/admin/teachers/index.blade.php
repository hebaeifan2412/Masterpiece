@extends('admin.layout.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0 fw-bold text-dark">Teacher Profiles</h2>
        {{-- <a href="{{ route('admin.teacher_profiles.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i> Add New Teacher
        </a> --}}
    </div>

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
                            <th>Username</th>
                            <th>Qualification</th>
                            <th>Gender</th>
                            <th>Date of Birth</th>
                            <th>Joining Date</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($teachers as $profile)
                        <tr>
                            <td class="ps-4 fw-medium">{{ $profile->id }}</td>
                            <td>{{ $profile->user->firstname }} {{ $profile->user->secname }}
                                {{ $profile->user->thirdname }} {{$profile->user->lastname }}</td>
                            <td>{{ $profile->qualification }}</td>
                            <td>
                                <span class="badge bg-{{ $profile->gender == 'male' ? 'info' : 'pink' }}-soft text-{{ $profile->gender == 'male' ? 'info' : 'pink' }}">
                                    {{ ucfirst($profile->gender) }}
                                </span>
                            </td>
                            <td>{{ $profile->dob }}</td>
                            <td>{{ $profile->joining_date }}</td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.teacher_profiles.edit', $profile->id) }}" 
                                       class="btn btn-sm btn-warning-soft text-warning rounded-circle"
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.teacher_profiles.destroy', $profile->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-danger-soft text-danger rounded-circle"
                                                title="Delete"
                                                onclick="return confirm('Are you sure you want to delete this teacher profile?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                <i class="fas fa-chalkboard-teacher fa-2x mb-3"></i>
                                <p class="mb-0">No teacher profiles found.</p>
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