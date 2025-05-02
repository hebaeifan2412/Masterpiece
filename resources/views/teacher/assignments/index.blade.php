@extends('teacher.layout.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">My Assignments</h2>
        <a href="{{ route('teacher.assignments.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Create Assignment
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Course</th>
                    <th>Due Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($assignments as $index => $assignment)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $assignment->title }}</td>
                        <td>{{ $assignment->course->title ?? 'N/A' }}</td>
                        <td>
                            <div><strong>Open:</strong> {{ \Carbon\Carbon::parse($assignment->open_time)->format('Y-m-d H:i') }}</div>
                            <div><strong>Close:</strong> {{ \Carbon\Carbon::parse($assignment->close_time)->format('Y-m-d H:i') }}</div>
                        </td>
                        {{-- <td>
                            <span class="badge {{ $assignment->status == 'show' ? 'bg-success' : 'bg-secondary' }}">
                                {{ ucfirst($assignment->status) }}
                            </span>
                        </td> --}}
                        <td class="d-flex gap-2">
                            <a href="{{ route('teacher.assignments.edit', $assignment->id) }}" class="btn btn-sm bb text-white">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('teacher.assignments.destroy', $assignment->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm ld">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            <a href="{{ route('teacher.assignments.submissions', $assignment->id) }}" class="btn btn-sm btn-primary text-white">
                                <i class="fas fa-file-alt"></i> Submissions
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">No assignments found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection