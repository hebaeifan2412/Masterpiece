@extends('admin.layout.app')

@section('content')
<form method="GET" action="{{ route('admin.marks.index') }}" class="row g-3 mb-4">
    <div class="col-md-3">
        <label for="class_id" class="form-label">Filter by Class</label>
        <select name="class_id" id="class_id" class="form-select">
            <option value="">All Classes</option>
            @foreach($classess as $class)
                <option value="{{ $class->id }}" {{ request('class_id') == $class->id ? 'selected' : '' }}>
                    {{ $class->grade->name }} - Section {{ $class->section }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <label for="teacher_id" class="form-label">Filter by Teacher</label>
        <select name="teacher_id" id="teacher_id" class="form-select">
            <option value="">All Teachers</option>
            @foreach($teachers as $teacher)
                <option value="{{ $teacher->id }}" {{ request('teacher_id') == $teacher->id ? 'selected' : '' }}>
                    {{ $teacher->user->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <label for="subject_id" class="form-label">Filter by Subject</label>
        <select name="subject_id" id="subject_id" class="form-select">
            <option value="">All Subjects</option>
            @foreach($subjects as $subject)
                <option value="{{ $subject->id }}" {{ request('subject_id') == $subject->id ? 'selected' : '' }}>
                    {{ $subject->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3 d-flex align-items-end">
        <button type="submit" class="btn btn-primary w-100">
            <i class="fas fa-filter me-1"></i> Apply Filters
        </button>
    </div>
</form>
@endsection