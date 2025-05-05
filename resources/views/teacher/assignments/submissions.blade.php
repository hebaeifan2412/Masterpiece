@extends('teacher.layout.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Submissions - {{ $assignment->title }}</h2>

    @if ($assignment->submissions->count() === 0)
        <div class="alert alert-info">No submissions yet.</div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-light">
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
                    @foreach ($assignment->submissions as $index => $submission)
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
                                <td>
                                    <input type="number" name="mark" class="form-control form-control-sm" value="{{ $submission->mark ?? '' }}" min="0" max="100">
                                </td>
                                <td>
                                    <textarea name="feedback" class="form-control form-control-sm" rows="2">{{ $submission->feedback }}</textarea>
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                                </td>
                            </tr>
                        </form>
                    @endforeach
                </tbody>
                
            </table>
        </div>
    @endif
</div>
@endsection
