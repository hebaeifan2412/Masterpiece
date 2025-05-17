@extends('student.layout.app')
@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h2 class="mb-4 h4 fw-bold">Quiz Results: {{ $quiz->title }}</h2>
            <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-star text-primary me-2 fs-5"></i>
                    <h6 class="mb-0 text-dark fw-semibold">Your Results</h6>
                </div>
                <div class="mark-display bg-white rounded-2 p-2 text-center d-inline-block">
                    <p class="mb-0 text-primary fw-bold fs-3">{{ $mark->marks }} / {{ $quiz->questions->count() }}</p>
                </div>
           
            @foreach ($quiz->questions as $index => $question)
                @php
                    $studentAnswer = $answers->where('quiz_question_id', $question->id)->first();
                    $selectedId = $studentAnswer?->selected_option_id;
                @endphp
                <div class="mb-4 p-3 border rounded">
                    <h5 class="fw-bold">Q{{ $index + 1 }}: {{ $question->question }}</h5>
                    @foreach ($question->options as $option)
                        <div class="form-check">
                            <input 
                                class="form-check-input" 
                                type="radio" 
                                name="result_question_{{ $question->id }}"
                                id="result_option_{{ $option->id }}"
                                disabled
                                {{ $selectedId == $option->id ? 'checked' : '' }}>
                            <label class="form-check-label {{ $option->is_correct ? 'text-success fw-bold' : ($selectedId == $option->id ? 'text-danger' : '') }}">
                                {{ $option->option_text }}
                                @if ($option->is_correct)
                                    <span class="badge bg-success">Correct</span>
                                @elseif ($selectedId == $option->id)
                                    <span class="badge bg-danger">Your Answer</span>
                                @endif
                            </label>
                        </div>
                    @endforeach
                </div>
            @endforeach

            <div class="d-flex justify-content-end mt-4">
                <a href="{{ route('student.quizzes.index') }}" class="btn btn-primary">Back to All Quizzes</a>
            </div>
        </div>
    </div>
</div>
@endsection
