<!-- Edit Modal for a Single Question -->
<div class="modal fade" id="editQuestionModal{{ $question->id }}" tabindex="-1" aria-labelledby="editQuestionModalLabel{{ $question->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('teacher.quizzes.questions.update', [$quiz->id, $question->id]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title">Edit Question</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    {{-- Question Text --}}
                    <div class="mb-3">
                        <label>Question</label>
                        <input type="text" name="question" class="form-control" value="{{ $question->question }}" required>
                    </div>

                    {{-- Options --}}
                    <div class="mb-3">
                        <label>Options</label>
                        @foreach($question->options as $index => $option)
                            <div class="input-group mb-2">
                                <span class="input-group-text">Option {{ $index + 1 }}</span>
                                <input type="text" name="options[{{ $option->id }}]" class="form-control" value="{{ $option->option_text }}" required>
                                <div class="input-group-text">
                                    <input type="radio" name="correct_option_id" value="{{ $option->id }}"
                                        {{ $option->is_correct ? 'checked' : '' }} required>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-secondary text-light" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
