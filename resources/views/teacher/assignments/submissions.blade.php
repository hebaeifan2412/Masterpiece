@extends('teacher.layout.app')

@section('content')
<div class="container py-4">
    <!-- Main Header -->
    <div class="border-bottom pb-3 mb-4">
        <!-- Title Row -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <!-- Left Side - Title -->
            <div class="d-flex align-items-center gap-3">
                <div class="bg-primary bg-opacity-10 p-2 rounded">
                    <i class="fas fa-file-import fs-4 text-light"></i>
                </div>
                <div>
                    <h2 class="mb-0">Submissions for {{ $assignment->title }}</h2>
                </div>
            </div>
            
            <!-- Right Side - Class and Due Date -->
            <div class="d-flex align-items-center gap-3">
                <div class="text-end">
                    <span class="d-block small text-muted">Class</span>
                    <span class="badge bg-primary bg-opacity-10 text-light fw-bold fs-6">
                        <i class="fas fa-users-class me-1"></i>
                        {{ $class->grade->name }} - {{ $class->section }}
                    </span>
                </div>
                <div class="vr mx-2"></div>
                <div class="text-end">
                    <span class="d-block small text-muted">Due Date</span>
                    <span class="badge bg-light text-dark">
                        <i class="fas fa-calendar-day me-1"></i>
                        {{ \Carbon\Carbon::parse($assignment->due_date)->format('M d, Y') }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Stats Row -->
        <div class="d-flex align-items-center gap-4">
            <div class="vr"></div>
           
            <div class="vr"></div>
            <div class="d-flex align-items-center">
                <span class="text-muted me-2">
                    <i class="fas fa-download me-1"></i>Submitted:
                </span>
                <span class="fw-bold text-primary">
                    {{ $submissions->count() }}
                </span>
                <span class="text-muted">/ {{ $students->count() }}</span>
                
            </div>
        </div>
    </div>


  @if ($submissions->count() === 0)

        <div class="alert alert-primary">             
            <i class="fas fa-info-circle me-2"></i>No submissions yet.</div>
    @else
    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="bg-primary text-light ">
                    <tr>
                        <th>#</th>
                        <th>Student</th>
                        <th>National ID</th>
                        <th>Submitted At</th>
                        <th>File</th>
                        <th>Mark</th>
                        <th>Feedback</th>
                        <th>Action</th>
                    </tr>
                </thead>
                
                <tbody>
@foreach ($submissions as $index => $submission)
                        <form method="POST" action="{{ route('teacher.assignments.submissions.mark', $submission->id) }}">
                            @csrf
                            @method('PUT')
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $submission->student->user->firstname ?? 'N/A' }} {{ $submission->student->user->lastname ?? '' }}</td>
                                <td>{{ $submission->student_id }}</td>
                                <td>{{ $submission->submitted_at ? \Carbon\Carbon::parse($submission->submitted_at)->format('Y-m-d H:i') : 'N/A' }}</td>
                                <td>
                                    @if ($submission->file_path)
                                        <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                            View File
                                        </a>
                                    @else
                                        <span class="text-muted">No file</span>
                                    @endif
                                </td>
                                <td class="align-middle">
    <div class="input-group input-group-sm" style="width: 120px;">
        <input type="number" name="mark" 
               class="form-control text-end" 
               value="{{ old('mark', $submission->mark) ?? '' }}" 
               min="0" max="{{ $assignment->fullmark }}"
               aria-label="Assignment mark">
        <span class="input-group-text bg-light">/ {{ $assignment->fullmark }}</span>
    </div>
    @if($submission->mark)
        <small class="text-muted d-block mt-1">
            Saved: {{ $submission->mark }}/{{ $assignment->fullmark }}
        </small>
    @endif
</td>
                                <td>
                                    <textarea name="feedback" class="form-control form-control-sm" rows="2">{{ $submission->feedback }}</textarea>
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-sm  btn-primary">                                            <i class="fas fa-check"></i>
</button>
                                </td>
                            </tr>
                        </form>
                    @endforeach
                </tbody>
                
            </table>
        </div>
    </div>
    @endif
</div>
@endsection
