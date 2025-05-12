<div class="modal fade" id="quizCreateModal" tabindex="-1" aria-labelledby="quizCreateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
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
    <label>Classes</label>
    <select name="class_ids[]" class="form-control" multiple required>
        @foreach(auth()->user()->teacherProfile->classes as $class)
            <option value="{{ $class->id }}"> {{ $class->grade->name }} - Section {{ $class->section }}</option>
        @endforeach
    </select>
    <small class="text-muted">Hold Ctrl (Windows) or Command (Mac) to select multiple.</small>
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
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-success">Create</button>
                </div>
            </div>
        </form>
    </div>
</div>
