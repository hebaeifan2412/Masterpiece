@extends('teacher.layout.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Create Assignment</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('teacher.assignments.store') }}">
        @csrf

      
        <div class="mb-3">
            <label class="form-label">Select Classes (for info/display only):</label>
            <div class="row">
                @foreach ($classess as $class)
                    <div class="col-md-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="classes_display[]" value="{{ $class->id }}" id="class_{{ $class->id }}">
                            <label class="form-check-label" for="class_{{ $class->id }}">
                                {{ $class->grade->name }} - {{ $class->section }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4"></textarea>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="open_time" class="form-label">Open Time</label>
                <input type="datetime-local" name="open_time" id="open_time" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="close_time" class="form-label">Close Time</label>
                <input type="datetime-local" name="close_time" id="close_time" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select" required>
                <option value="show">Show to students</option>
                <option value="hide">Hide from students</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">  
             <i class="fas fa-save me-1"></i>
             Create Assignment</button>
    </form>
</div>
@endsection
