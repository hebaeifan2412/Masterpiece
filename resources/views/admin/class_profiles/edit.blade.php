@extends('admin.layout.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-dark mb-4"><i class="fa-solid fa-file-pen me-2"></i>Edit Class</h2>
    <form action="{{ route('admin.class_profiles.update', $classProfile->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Hidden and disabled grade info -->
        <input type="hidden" name="grade_id" value="{{ $grade->id }}">
        <div class="mb-3">
            <label class="form-label fw-bold">Grade:</label>
            <p class="form-control-plaintext">{{ $grade->name }}</p>
        </div>

        <!-- Section is fixed and shown only as text -->
        <input type="hidden" name="section" value="{{ $classProfile->section }}">
        <div class="mb-3">
            <label class="form-label fw-bold">Section:</label>
            <p class="form-control-plaintext">{{ $classProfile->section }}</p>
        </div>

        <div class="form-group">
            <label for="capacity">Capacity</label>
            <input type="number" name="capacity" class="form-control" value="{{ $classProfile->capacity }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.grades.class_profiles', ['grade' => $grade->id]) }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
