<div class="modal fade" id="quizCreateModal" tabindex="-1" aria-labelledby="quizCreateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('teacher.quizzes.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Quiz</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="teacher_id" value="{{ auth()->user()->teacherProfile->id }}">

                    <div class="mb-3">
                        <label>Quiz Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="grade_id">Select Grade</label>
                        <select name="grade_id" id="grade_id" class="form-select" required>
                            <option value="">-- Select Grade --</option>
                            @foreach ($grades as $grade)
                                <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Assign to Sections</label>
                        <div id="sections-container">
                            <p class="text-muted">Please select a grade first.</p>
                        </div>
                    </div>


                    <div class="mb-3">
                        <label>Start Time</label>
                        <input type="datetime-local" name="start_time" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>End Time</label>
                        <input type="datetime-local" name="end_time" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Duration (minutes)</label>
                        <input type="number" name="duration" class="form-control" min="1" required>
                    </div>

                    <div class="mb-3">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            <option value="show">Show</option>
                            <option value="hide">Hide</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary text-light" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary">Create</button>
                </div>
            </div>
        </form>
    </div>
</div>
@push('scripts')
    <script>
       $(document).on('shown.bs.modal', '#quizCreateModal', function () {
    const gradeSelect = document.getElementById('grade_id');
    const sectionsContainer = document.getElementById('sections-container');

    function loadSections(gradeId) {
        if (!gradeId) {
            sectionsContainer.innerHTML = '<p class="text-muted">Please select a grade first.</p>';
            return;
        }

        fetch(`/teacher/grade/${gradeId}/sections`)
            .then(response => response.json())
            .then(data => {
                if (data.length === 0) {
                    sectionsContainer.innerHTML = '<p class="text-warning">No sections found for this grade.</p>';
                    return;
                }

                let html = '';
                data.forEach(section => {
                    html += `
                        <div class="form-check  ms-4">
                            <input class="form-check-input" type="checkbox" name="class_ids[]" value="${section.id}" id="section_${section.id}">
                            <p class="form-check " for="section_${section.id}">
                                 - Section ${section.section}
                            </p>
                        </div>
                    `;
                });
                sectionsContainer.innerHTML = html;
            })
            .catch(() => {
                sectionsContainer.innerHTML = '<p class="text-danger">Failed to load sections.</p>';
            });
    }

    gradeSelect.addEventListener('change', function () {
        loadSections(this.value);
    });

   if (gradeSelect.value) {
    gradeSelect.dispatchEvent(new Event('change'));
}
});


    </script>
@endpush
