@extends('teacher.layout.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Edit Assignment</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('teacher.assignments.update', $assignment->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Grade selection -->
        <div class="mb-3">
            <label class="form-label">Grade</label>
            <select name="grade_id" id="grade_id" class="form-select" required>
                <option value="">-- Select Grade --</option>
                @foreach ($grades as $grade)
                    <option value="{{ $grade->id }}" 
                        {{ in_array($grade->id, $assignment->classProfiles->pluck('grade_id')->toArray()) ? 'selected' : '' }}>
                        {{ $grade->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Sections -->
        <div class="mb-3">
            <label class="form-label">Select Sections</label>
            <div class="row" id="sections-container">
                @foreach ($classess as $class)
                    <div class="col-md-3 section-option" data-grade="{{ $class->grade_id }}">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="class_ids[]"
                                value="{{ $class->id }}" id="class_{{ $class->id }}"
                                {{ $assignment->classProfiles->contains($class->id) ? 'checked' : '' }}>
                            <label class="form-check-label" for="class_{{ $class->id }}">
                                {{ $class->grade->name }} - Section {{ $class->section }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Title -->
        <div class="mb-3">
            <label for="title" class="form-label">Assignment Title</label>
            <input type="text" name="title" class="form-control" value="{{ $assignment->title }}" required>
        </div>

        <!-- Description -->
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4">{{ $assignment->description }}</textarea>
        </div>

        <!-- Full mark -->
        <div class="mb-3">
            <label class="form-label">Full Mark</label>
            <input type="number" name="fullmark" class="form-control" value="{{ $assignment->fullmark }}" min="1" required>
        </div>

        <!-- Times -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Open Time</label>
                <input type="datetime-local" name="open_time" class="form-control" value="{{ $assignment->open_time }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Close Time</label>
                <input type="datetime-local" name="close_time" class="form-control" value="{{ $assignment->close_time }}" required>
            </div>
        </div>

        <!-- Attachment -->
        <div class="mb-3">
            <label class="form-label">Attachment (optional)</label>
            @if ($assignment->attachment)
                <div class="mb-2">
                    <a href="{{ asset('storage/' . $assignment->attachment) }}" target="_blank">View current file</a>
                </div>
            @endif
            <input type="file" name="attachment" class="form-control" accept=".pdf,.doc,.docx,.jpg,.png">
        </div>

        <!-- Status -->
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select" required>
                <option value="show" {{ $assignment->status == 'show' ? 'selected' : '' }}>Show to students</option>
                <option value="hide" {{ $assignment->status == 'hide' ? 'selected' : '' }}>Hide from students</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save me-1"></i> Update Assignment
        </button>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const gradeSelect = document.getElementById('grade_id');
        const sectionOptions = document.querySelectorAll('.section-option');

        gradeSelect.addEventListener('change', function () {
            const selectedGradeId = this.value;

            sectionOptions.forEach(option => {
                const isMatch = option.getAttribute('data-grade') === selectedGradeId;
                option.style.display = isMatch ? 'block' : 'none';
                if (!isMatch) {
                    option.querySelector('input').checked = false;
                }
            });
        });

        // Initial trigger
        if (gradeSelect.value) {
            gradeSelect.dispatchEvent(new Event('change'));
        }
    });
</script>
@endpush
