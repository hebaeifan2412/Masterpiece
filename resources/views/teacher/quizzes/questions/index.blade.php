@extends('teacher.layout.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">
            <i class="fas fa-question-circle me-2"></i> Quiz: {{ $quiz->title }}
        </h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#questionCreateModal">
            <i class="fas fa-plus me-1"></i> Add Question
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white py-3">
            <h5 class="mb-0"><i class="fas fa-list-ol me-2"></i> Questions</h5>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">#</th>
                            <th>Question</th>
                            <th>Options</th>
                            <th>Correct Answer</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($quiz->questions as $index => $question)
                        <tr>
                            <td class="ps-4 fw-bold">{{ $index + 1 }}</td>
                            <td>{{ $question->question }}</td>
                            <td>
                                @if($question->options && $question->options->isNotEmpty())
                                    <ol class="mb-0 ps-3">
                                        @foreach($question->options as $option)
                                        <li class="{{ $option->is_correct ? 'text-success fw-bold' : '' }}">
                                            {{ $option->option_text }}
                                        </li>
                                        @endforeach
                                    </ol>
                                @else
                                    <span class="text-muted">No options available</span>
                                @endif
                            </td>
                            <td>
                                @if($question->options && $question->options->isNotEmpty())
                                    @foreach($question->options as $option)
                                        @if($option->is_correct)
                                            <span class="badge bg-success">
                                                {{ $option->option_text }}
                                            </span>
                                        @endif
                                    @endforeach
                                @else
                                    <span class="text-muted">No correct answer</span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <button class="btn btn-sm btn-outline-warning" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editQuestionModal{{ $question->id }}"
                                            data-bs-toggle="tooltip" title="Edit Question">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    
                                    <form method="POST" 
                                          action="{{ route('teacher.quizzes.questions.destroy', [$quiz->id, $question->id]) }}" 
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Are you sure you want to delete this question?')"
                                                data-bs-toggle="tooltip" title="Delete Question">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @include('teacher.quizzes.questions.edit', ['quiz' => $quiz, 'question' => $question])
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">
                                <i class="fas fa-info-circle me-2"></i> No questions found. Add your first question!
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('teacher.quizzes.questions.create', ['quiz' => $quiz])

@endsection

@push('scripts')
<script>
    // Enable Bootstrap tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });
</script>
@endpush