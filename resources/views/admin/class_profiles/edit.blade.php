@extends('admin.layout.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-warning mb-4">Edit Class</h2>
    <form action="{{ route('admin.class_profiles.update', $classProfile->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="grade_id">Grade</label>
            <select name="grade_id" class="form-control" required>
                @foreach($grades as $grade)
                    <option value="{{ $grade->id }}" {{ $classProfile->grade_id == $grade->id ? 'selected' : '' }}>
                        {{ $grade->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="section">Section</label>
            <select name="section" class="form-control" required>
                <option value="A" {{ $classProfile->section == 'A' ? 'selected' : '' }}>A</option>
                <option value="B" {{ $classProfile->section == 'B' ? 'selected' : '' }}>B</option>
                <option value="C" {{ $classProfile->section == 'C' ? 'selected' : '' }}>C</option>
            </select>
        </div>
        <div class="form-group">
            <label for="capacity">Capacity</label>
            <input type="number" name="capacity" class="form-control" value="{{ $classProfile->capacity }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.class_profiles.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
