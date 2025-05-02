@extends('admin.layout.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-success mb-4">Add New Class</h2>
    <form action="{{ route('admin.class_profiles.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="grade_id">Grade</label>
            <select name="grade_id" class="form-control" required>
                <option value="">Select Grade</option>
                @foreach($grades as $grade)
                    <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="section">Section</label>
            <select name="section" class="form-control" required>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
            </select>
        </div>
        <div class="form-group">
            <label for="capacity">Capacity</label>
            <input type="number" name="capacity" class="form-control" value="30" required>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
        <a href="{{ route('admin.class_profiles.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
