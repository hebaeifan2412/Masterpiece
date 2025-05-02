@extends('admin.layout.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Create New Subject</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.courses.store') }}" method="POST">
        @csrf
       
        <div class="mb-3">
            <label for="subject_id" class="form-label">Subject</label>
            <select name="subject_id" id="subject_id" class="form-control text-dark" required>
                 <option value="">Select Subject</option>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                        {{ $subject->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="teacher_id" class="form-label">Teacher</label>
            <select name="teacher_id" id="teacher_id" class="form-control text-dark" required>
                <option value="">Select Teacher</option>
                @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                        {{ $teacher->user->firstname }} {{ $teacher->user->lastname }}  

                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="class_id" class="form-label">Class</label>
            <select name="class_id" id="class_id" class="form-control text-dark" required>
                <option value="">Select Class</option>
                @foreach($classProfiles as $class)
                    <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>
                        {{ $class->grade->name }} - {{ $class->section }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Create Course</button>
            <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
