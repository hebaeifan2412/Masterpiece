@extends('student.layout.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 fw-bold">Assignments</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @forelse ($assignments as $assignment)
        @php
            $submission = $assignment->submissions->where('student_id', auth()->user()->student->national_id)->first();
            $now = now();

            $subjectName = $assignment->classProfiles
                ->flatMap->teachers
                ->pluck('subject.name')
                ->unique()
                ->implode(', ');
        @endphp

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">{{ $assignment->title }}</h5>
                <p class="card-text">{{ $assignment->description ?? 'No description.' }}</p>
                <p class="mb-1"><strong>Subject:</strong> {{ $subjectName ?: 'N/A' }}</p>
                <p class="mb-1">
                    <strong>Open:</strong> {{ \Carbon\Carbon::parse($assignment->open_time)->format('Y-m-d H:i') }} <br>
                    <strong>Close:</strong> {{ \Carbon\Carbon::parse($assignment->close_time)->format('Y-m-d H:i') }}
                </p>

                @if ($submission)
                    <div class="mt-3">
                        <p class="text-primary mb-1">You have submitted this assignment:</p>
                        <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank" class="btn lb btn-sm">
                            <i class="fas fa-file-download me-1"></i> View Submission
                        </a>

                        @if ($now->between($assignment->open_time, $assignment->close_time))
                            <form action="{{ route('student.assignments.submission.delete', $submission->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete your submission?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn ld btn-sm ms-2">
                                    <i class="fas fa-trash-alt"></i> Delete Submission
                                </button>
                            </form>
                        @else
                            <div class="text-muted mt-2">Submission time has ended.</div>
                        @endif
                    </div>
                @elseif($now->between($assignment->open_time, $assignment->close_time))
                    <form action="{{ route('student.assignments.submit', $assignment->id) }}" method="POST" enctype="multipart/form-data" class="mt-3">
                        @csrf
                        <div class="mb-2">
                            <label for="file" class="form-label">Upload File</label>
                            <input type="file" name="file" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fas fa-upload me-1"></i> Submit Assignment
                        </button>
                    </form>
                @else
                    <div class="alert alert-warning mt-3">Submission is not allowed at this time.</div>
                @endif
            </div>
        </div>
    @empty
        <div class="alert alert-info">No assignments available for your class.</div>
    @endforelse
</div>
@endsection
