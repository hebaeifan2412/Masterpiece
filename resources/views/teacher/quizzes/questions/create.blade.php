<div class="modal fade" id="questionCreateModal" tabindex="-1" aria-labelledby="questionCreateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('teacher.quizzes.questions.store', $quiz->id) }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Question</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Question</label>
                        <textarea name="question" class="form-control" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Options</label>
                        <input type="text" name="options[0]" class="form-control mb-2" placeholder="Option 1" required>
                        <input type="text" name="options[1]" class="form-control mb-2" placeholder="Option 2" required>
                        <input type="text" name="options[2]" class="form-control mb-2" placeholder="Option 3" required>
                        <input type="text" name="options[3]" class="form-control mb-2" placeholder="Option 4" required>
                    </div>

                    <div class="mb-3">
                        <label>Correct Answer</label>
                        <select name="correct_index" class="form-control" required>
                            <option value="0">Option 1</option>
                            <option value="1">Option 2</option>
                            <option value="2">Option 3</option>
                            <option value="3">Option 4</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Add Question</button>
                </div>
            </div>
        </form>
    </div>
</div>
