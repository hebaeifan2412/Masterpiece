@extends('student.layout.app')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4 fw-bold"> <i class="fas fa-clipboard  text-dark me-3"></i>Assignments</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @forelse ($assignments as $assignment)
            @php
                $submission = $assignment->submissions
                    ->where('student_id', auth()->user()->student->national_id)
                    ->first();
                $now = now();

                $subjectName = $assignment->classProfiles->flatMap->teachers
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
                            <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank"
                                class="btn lb btn-sm">
                                <i class="fas fa-file-download me-1"></i> View Submission
                            </a>

                            @if ($now->between($assignment->open_time, $assignment->close_time))
                                <form action="{{ route('student.assignments.submission.delete', $submission->id) }}"
                                    method="POST" class="d-inline" onsubmit="return confirm('Delete your submission?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn ld btn-sm ms-2">
                                        <i class="fas fa-trash-alt"></i> Delete Submission
                                    </button>
                                </form>
                                @if ($submission && $submission->mark !== null)
                                   
                                        {{-- <div class="bg-success bg-gradient rounded-circle d-flex align-items-center justify-content-center mb-3 text-white"
                                            style="width: 70px; height: 70px;">
                                            <h3 class="m-0"></h3>
                                        </div> --}}

                                      <div class="feedback-container bg-white rounded-3 shadow-sm p-0 overflow-hidden my-4">
    <!-- Results Section -->
    <div class="result-section h p-4 border-bottom border-2 border-light">
        <div class="d-flex align-items-center mb-2">
            <i class="fas fa-star text-primary me-2 fs-5"></i>
            <h6 class="mb-0 text-dark fw-semibold">Your Results</h6>
        </div>
        <div class="mark-display bg-white rounded-2 p-2 text-center d-inline-block">
            <p class="mb-0 text-primary fw-bold fs-3">{{ $submission->mark }} / {{ $submission->fullmark }}</p>
        </div>
    </div>
    
    <!-- Feedback Section -->
    <div class="feedback-section p-4">
        <div class="d-flex align-items-center mb-3">
            <i class="fas fa-comment-alt text-primary me-2 fs-5"></i>
            <h6 class="mb-0 text-dark fw-semibold">Feedback</h6>
        </div>
        <div class="feedback-text h p-3 rounded-2">
            <p class="mb-0 text-dark lh-base">
                {{ $submission->feedback ?? 'No feedback provided yet.' }}
            </p>
        </div>
    </div>
</div>
                                @else
                                    <div class="alert alert-primary mt-3">
                                        <strong><i class="fas fa-info-circle me-2"></i> Not graded yet.</strong>
                                    </div>
                                @endif
                            @else
                                <div class="text-muted mt-2">Submission time has ended.</div>
                            @endif
                        </div>
                    @elseif($now->between($assignment->open_time, $assignment->close_time))
                        <form action="{{ route('student.assignments.submit', $assignment->id) }}" method="POST"
                            enctype="multipart/form-data" class="mt-3">
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
                        <div class="alert alert-primary mt-3">
                            <i class="fas fa-info-circle me-2"></i>Submission is not allowed at this time.
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="alert alert-primary">No assignments available for your class.</div>
        @endforelse
    </div>
@endsection
