@extends('teacher.layout.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Edit Assignment</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('teacher.assignments.update', $assignment->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Course</label>
            <select name="course_id" class="form-select" required>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}" {{ $assignment->course_id == $course->id ? 'selected' : '' }}>
                        {{ $course->title }} ({{ $course->code }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $assignment->title) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4">{{ old('description', $assignment->description) }}</textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Open Time</label>
                <input type="datetime-local" name="open_time" class="form-control"
                value="{{ old('open_time', $assignment->open_time) }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Close Time</label>
                <input type="datetime-local" name="close_time" class="form-control"
       value="{{ old('close_time', $assignment->close_time) }}" required>

            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select" required>
                <option value="show" {{ $assignment->status === 'show' ? 'selected' : '' }}>Show to students</option>
                <option value="hide" {{ $assignment->status === 'hide' ? 'selected' : '' }}>Hide from students</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save me-1"></i> Update Assignment
        </button>
    </form>
</div>
@endsection
