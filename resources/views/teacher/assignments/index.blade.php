@extends('teacher.layout.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0"><i class="fas fa-tasks me-2"></i>My Assignments</h2>
        <a href="{{ route('teacher.assignments.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Create Assignment
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="bg-primary text-light">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Subject</th>
                    <th>Due Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($assignments as $index => $assignment)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $assignment->title }}</td>
                       <td>
    
</td>

                        <td>
                            <div class="mb-2"><strong>Open:</strong> {{ \Carbon\Carbon::parse($assignment->open_time)->format('Y-m-d H:i') }}</div>
                            <div><strong>Close:</strong> {{ \Carbon\Carbon::parse($assignment->close_time)->format('Y-m-d H:i') }}</div>
                        </td>
                       
                        <td class="d-flex gap-2">
                            <a href="{{ route('teacher.assignments.edit', $assignment->id) }}"
                                 class="btn btn-sm btn-secondary  text-white">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form id="delete-form-{{ $assignment->id }}" 
      action="{{ route('teacher.assignments.destroy', $assignment->id) }}" 
      method="POST" style="display: inline;">
    @csrf
    @method('DELETE')
    <button type="button" class="btn btn-sm ld delete-btn" data-id="{{ $assignment->id }}">
        <i class="fas fa-trash"></i>
    </button>
</form>
                            <div class="dropdown">
        <button class="btn btn-sm bb text-light fw-bold dropdown-toggle" type="button" data-bs-toggle="dropdown">
            Select Class
        </button>
        <ul class="dropdown-menu">
            @foreach ($assignment->classProfiles as $class)
                @php
                    $totalStudents = $class->students->count();
                    $submitted = $assignment->submissions->where('class_id', $class->id)->count();
                @endphp
                <li>
                    <a class="dropdown-item d-flex justify-content-between align-items-center"
                       href="{{ route('teacher.assignments.submissions', ['id' => $assignment->id, 'class' => $class->id]) }}">
                        {{ $class->grade->name }} - {{ $class->section }}
                        <span class="badge bg-primary ms-2">{{ $submitted }} / {{ $totalStudents }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
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
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be undone.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${id}`).submit();
                }
            });
        });
    });
});
</script>
@endpush
