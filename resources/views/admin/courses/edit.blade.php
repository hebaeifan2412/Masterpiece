@extends('admin.layout.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Edit Course</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.courses.update', $course->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Course Title</label>
            <input type="text" name="title" id="title" class="form-control" required value="{{ old('title', $course->title) }}">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" rows="4" class="form-control">{{ old('description', $course->description) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="subject_id" class="form-label">Subject</label>
            <select name="subject_id" id="subject_id" class="form-control" required>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}" {{ old('subject_id', $course->subject_id) == $subject->id ? 'selected' : '' }}>
                        {{ $subject->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="teacher_id" class="form-label">Teacher</label>
            <select name="teacher_id" id="teacher_id" class="form-control" required>
                @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}" {{ old('teacher_id', $course->teacher_id) == $teacher->id ? 'selected' : '' }}>
                        {{ $teacher->user->username }} ({{ $teacher->qualification }})
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="class_id" class="form-label">Class</label>
            <select name="class_id" id="class_id" class="form-control" required>
                @foreach($classProfiles as $class)
                    <option value="{{ $class->id }}" {{ old('class_id', $course->class_id) == $class->id ? 'selected' : '' }}>
                        {{ $class->grade->name }} - {{ $class->section }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-warning">Update Course</button>
            <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
