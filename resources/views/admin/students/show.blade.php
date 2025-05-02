@extends('admin.layout.app')

@section('content')
<div class="container">
    <h2>Student Details</h2>
    <p><strong>National ID:</strong> {{ $student->national_id }}</p>
    <p><strong>Date of Birth:</strong> {{ $student->date_of_birth }}</p>
    <p><strong>Class:</strong> Grade {{ $student->classProfile->grade->name ?? '' }} - Section {{ $student->classProfile->section }}</p>
    <p><strong>Status:</strong> {{ ucfirst($student->student_status) }}</p>
    <p><strong>Address:</strong> {{ $student->address }}</p>
    <p><strong>Father Phone:</strong> {{ $student->father_phone }}</p>
    <p><strong>Mother Name:</strong> {{ $student->mother_name }}</p>
    <p><strong>Mother Phone:</strong> {{ $student->mother_phone }}</p>

    <h4>Courses for This Class</h4>
    <ul>
        @foreach($student->classProfile->courses as $course)
            <li>{{ $course->title }} ({{ $course->subject->name ?? '' }})</li>
        @endforeach
    </ul>

    <a href="{{ route('admin.students.index') }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection
