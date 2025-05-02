@extends('student.layout.app')
@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <h2 class="mb-0 h3 fw-bold text-primary">Available Quizzes</h2>
    </div>
    
    <div class="row g-4">
        @foreach ($quizzes as $quiz)
            @php
                $now = \Carbon\Carbon::now();
                $start = \Carbon\Carbon::parse($quiz->start_time);
                $end = \Carbon\Carbon::parse($quiz->end_time);
                $statusClass = '';
                $statusText = '';
                $hasAnswered = $quiz->studentAnswers->where('student_id', Auth::user()->student->national_id)->count() > 0;

                if ($now->lt($start)) {
                    $statusClass = 'bg-warning';
                    $statusText = 'Not Started Yet';
                } elseif ($now->gt($end)) {
                    $statusClass = 'bg-danger';
                    $statusText = 'Closed';
                } else {
                    $statusClass = 'bg-success';
                    $statusText = 'Available';
                }
            @endphp
            
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm overflow-hidden">
                    <div class="card-header {{ $statusClass }} py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge {{ str_replace('subtle', '', $statusClass) }}">{{ $statusText }}</span>
                            <small class="text-light">{{ $quiz->duration }} mins</small>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title fw-semibold mb-3">{{ $quiz->title }}</h5>
                        
                        <div class="d-flex align-items-center mb-2">
                            <i class="far fa-calendar-alt me-2 text-muted"></i>
                            <small class="text-muted">{{ $start->format('d M Y') }}</small>
                        </div>
                        
                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <div class="border rounded p-2 text-center">
                                    <small class="d-block text-muted">Start</small>
                                    <strong>{{ $start->format('h:i A') }}</strong>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="border rounded p-2 text-center">
                                    <small class="d-block text-muted">End</small>
                                    <strong>{{ $end->format('h:i A') }}</strong>
                                </div>
                            </div>
                        </div>

                        @if ($hasAnswered)
                            <a href="{{ route('student.quizzes.results', $quiz->id) }}" class="btn btn-outline-primary w-100">
                                <i class="fas fa-eye me-1"></i> View Result
                            </a>
                        @elseif ($now->between($start, $end))
                            <button 
                                class="btn btn-primary w-100 mt-2 start-quiz-btn"
                                data-bs-toggle="modal" 
                                data-bs-target="#startQuizModal"
                                data-quiz-id="{{ $quiz->id }}"
                                data-quiz-title="{{ $quiz->title }}">
                                <i class="fas fa-play-circle me-1"></i> Start Quiz
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="startQuizModal" tabindex="-1" aria-labelledby="startQuizModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow">
      <div class="modal-header border-0 bg-primary text-white">
        <h5 class="modal-title" id="startQuizModalLabel">Confirm Quiz Start</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body py-4">
        <div class="text-center mb-3">
            <i class="fas fa-question-circle fa-3x text-primary mb-3"></i>
            <h5 id="quizTitle">Are you ready to start this quiz?</h5>
            <p class="text-muted mt-2">Once started, the timer will begin and cannot be paused.</p>
        </div>
      </div>
      <div class="modal-footer border-0 justify-content-center">
        <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">Cancel</button>
        <form method="GET" id="startQuizForm">
            <button type="submit" class="btn btn-primary px-4">
                <i class="fas fa-play me-1"></i> Start Now
            </button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modalElement = document.getElementById('startQuizModal');
        const quizTitle = document.getElementById('quizTitle');
        const startQuizForm = document.getElementById('startQuizForm');

        modalElement.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const quizId = button.getAttribute('data-quiz-id');
            const title = button.getAttribute('data-quiz-title');

            quizTitle.innerHTML = `Are you ready to start <strong>\"${title}\"</strong>?`;
            startQuizForm.action = `/student/quiz/${quizId}`;
        });
    });
</script>

<style>
    .card {
        transition: transform 0.2s, box-shadow 0.2s;
        border-radius: 10px;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .start-quiz-btn {
        transition: all 0.3s;
    }
    .modal-content {
        border-radius: 15px;
        overflow: hidden;
    }
</style>
@endsection
