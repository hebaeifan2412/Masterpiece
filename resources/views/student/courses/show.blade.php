@extends('student.layout.app') 

@section('content')
<div class="container mt-4">

    <h2>{{ $course->name }}</h2>

    <div class="mb-4">
        <h5>🧑‍🏫 Teacher:</h5>
        <p>{{ $course->teacher->name ?? 'No teacher assigned' }}</p>
    </div>

    <div class="mb-4">
        <h5>📝 Quizzes:</h5>
        @if($course->quizzes->count())
            <ul class="list-group">
                @foreach($course->quizzes as $quiz)
                    <li class="list-group-item">{{ $quiz->title }}</li>
                @endforeach
            </ul>
        @else
            <p>No quizzes available for this course.</p>
        @endif
    </div>

    <div class="mb-4">
        <h5>📚 Assignments:</h5>
        @if($course->assignments->count())
            <ul class="list-group">
                @foreach($course->assignments as $assignment)
                    <li class="list-group-item">{{ $assignment->title }}</li>
                @endforeach
            </ul>
        @else
            <p>No assignments available for this course.</p>
        @endif
    </div>

    <a href="{{ route('student.courses.index') }}" class="btn btn-secondary">🔙 Back to Courses</a>

</div>
@endsection
