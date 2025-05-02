@extends('admin.layout.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0 fw-bold text-dark">Courses Management</h2>
        <a href="{{ route('admin.courses.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i> Add New Course
        </a>
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
                    <thead class="bg-primary text-light">
                        <tr>
                            <th class="ps-4">#</th>
                            <th class="ps-1">Subject</th>
                            <th>Teacher</th>
                            <th>Class</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($courses as $index => $course)
                        <tr>
                            <td class="ps-4 fw-medium">{{ $index + 1 }}</td>
                            <td>
                                <span class=" bg-primary-soft text-primary">
                                    {{ $course->subject->name }}
                                </span>
                            </td>
                            <td>
                             
                                    {{-- <div class="avatar-xs bg-info-soft text-info rounded-circle me-2 d-flex align-items-center justify-content-center">
                                        <i class="fas fa-user fa-xs"></i>
                                    </div> --}}
                                  <div>{{ $course->teacher->user->firstname ?? 'N/A' }} {{ $course->teacher->user->lastname ?? '' }}
                                    </div>
                            </td>
                            <td>
                                <span class=" text-dark">
                                    {{ $course->classProfile->grade->name }} - {{ $course->classProfile->section }}
                                </span>
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.courses.show', $course->id) }}" 
                                       class="btn btn-sm btn-primary-soft text-primary rounded-circle"
                                       title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.courses.edit', $course->id) }}" 
                                       class="btn btn-sm btn-warning-soft text-warning rounded-circle"
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-danger-soft text-danger rounded-circle"
                                                title="Delete"
                                                onclick="return confirm('Are you sure you want to delete this course?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                <i class="fas fa-book-open fa-2x mb-3"></i>
                                <p class="mb-0">No courses found.</p>
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
