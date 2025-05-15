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

    <form method="POST" action="{{ route('teacher.assignments.store') }}" enctype="multipart/form-data">
        @csrf
<!-- Grade -->
<div class="mb-3">
    <label class="form-label">Select Grade</label>
    <select name="grade_id" id="grade_id" class="form-select" required>
        <option value="">-- Select Grade --</option>
        @foreach ($grades as $grade)
            <option value="{{ $grade->id }}">{{ $grade->name }}</option>
        @endforeach
    </select>
</div>

<!-- Sections -->
<div class="mb-3">
    <label class="form-label">Select Sections</label>
    <div id="sections-container" class="row">
        <!-- sections will be loaded here -->
    </div>
</div>


        <!-- Title -->
        <div class="mb-3">
            <label class="form-label">Assignment Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <!-- Description -->
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4"></textarea>
        </div>

        <!-- Full mark -->
        <div class="mb-3">
            <label class="form-label">Full Mark</label>
            <input type="number" name="fullmark" class="form-control" min="1" value="100" required>
        </div>

        <!-- Time -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Open Time</label>
                <input type="datetime-local" name="open_time" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Close Time</label>
                <input type="datetime-local" name="close_time" class="form-control" required>
            </div>
        </div>

        <!-- File -->
        <div class="mb-3">
            <label class="form-label">Attach File (optional)</label>
            <input type="file" name="attachment" class="form-control" accept=".pdf,.doc,.docx,.jpg,.png">
        </div>

        <!-- Status -->
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select" required>
                <option value="show">Show to students</option>
                <option value="hide">Hide from students</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save me-1"></i> Create Assignment
        </button>
    </form>
</div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const gradeSelect = document.getElementById('grade_id');
        const sectionContainer = document.getElementById('sections-container');

        gradeSelect.addEventListener('change', function () {
            const gradeId = this.value;
            sectionContainer.innerHTML = '';

            if (!gradeId) return;

            fetch(`/teacher/sections-by-grade/${gradeId}`)
                .then(res => {
                    if (!res.ok) {
                        throw new Error("Failed to fetch sections");
                    }
                    return res.json();
                })
                .then(data => {
                    if (data.length === 0) {
                        sectionContainer.innerHTML = `
                            <div class="col-12">
                                <div class="alert alert-warning">No sections found for this grade.</div>
                            </div>`;
                    } else {
                        data.forEach(section => {
                            sectionContainer.innerHTML += `
                                <div class="col-md-3">
                                    <div class="form-check ms-3">
                                        <input class="form-check-input" type="checkbox" name="class_ids[]" value="${section.id}" id="class_${section.id}">
                                        <p class="form-check-label " for="class_${section.id}">
                                             - Section ${section.section}
                                        </p>
                                    </div>
                                </div>`;
                        });
                    }
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                    sectionContainer.innerHTML = `
                        <div class="col-12">
                            <div class="alert alert-danger">Error loading sections.</div>
                        </div>`;
                });
        });
    });
</script>
