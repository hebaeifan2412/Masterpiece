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
                        <label class="form-label">Assign to Classes</label>
                        @foreach ($classess as $class)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="class_ids[]"
                                    value="{{ $class->id }}" id="class{{ $class->id }}">
                                <label class="form-check-label" for="class{{ $class->id }}">
                                    {{ $class->grade->name }} - Section {{ $class->section }}
                                </label>
                            </div>
                        @endforeach
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
