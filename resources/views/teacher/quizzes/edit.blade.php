@extends('teacher.layout.app')

@section('content')
<div class="container">
    <h2>Edit Quiz</h2>

    <form action="{{ route('teacher.quizzes.update', $quiz->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Quiz Title</label>
            <input type="text" name="title" class="form-control" value="{{ $quiz->title }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Course</label>
            <select name="course_id" class="form-select" required>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}" {{ $quiz->course_id == $course->id ? 'selected' : '' }}>
                        {{ $course->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Duration (minutes)</label>
            <input type="number" name="duration" class="form-control" value="{{ $quiz->duration }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Start Time</label>
            <input type="datetime-local" name="start_time" class="form-control" value="{{ \Carbon\Carbon::parse($quiz->start_time)->format('Y-m-d\TH:i') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">End Time</label>
            <input type="datetime-local" name="end_time" class="form-control" value="{{ \Carbon\Carbon::parse($quiz->end_time)->format('Y-m-d\TH:i') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Quiz</button>
    </form>
</div>
@endsection
