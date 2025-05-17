<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>School Student</title>
    @include('student.layout.style') {{-- Include CSS --}}
</head>

<body>
    <div class="container-scroller">
<div class="container py-5">
    <div class="quiz-container">
        <!-- Quiz Header -->
        <div class="quiz-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="quiz-title">{{ $quiz->title }}</h1>
                    <div class="quiz-meta">
                        <span class="badge bg-purple-light text-purple">
                            <i class="fas fa-clock me-1"></i> {{ $quiz->duration }} minutes
                        </span>
                    </div>
                </div>
                <div class="quiz-timer">
                    <div class="timer-circle">
                        <svg class="timer-svg" viewBox="0 0 36 36">
                            <path class="timer-circle-bg"
                                d="M18 2.0845
                                a 15.9155 15.9155 0 0 1 0 31.831
                                a 15.9155 15.9155 0 0 1 0 -31.831"
                            />
                            <path id="timer-path" class="timer-circle-fill"
                                stroke-dasharray="100, 100"
                                d="M18 2.0845
                                a 15.9155 15.9155 0 0 1 0 31.831
                                a 15.9155 15.9155 0 0 1 0 -31.831"
                            />
                        </svg>
                        <span id="quizTimer" class="timer-text">--:--</span>
                    </div>
                </div>
            </div>
            
            <!-- Progress Bar -->
            {{-- <div class="quiz-progress mt-4">
                <div class="d-flex justify-content-between mb-2">
                    <span class="progress-label">Quiz Progress</span>
                    <span class="progress-percent"><span id="progressPercentage">0</span>%</span>
                </div>
                <div class="progress-track">
                    <div id="quizProgressBar" class="progress-fill"></div>
                </div>
            </div>
        </div> --}}

        <!-- Quiz Questions -->
        <form method="POST" action="{{ route('student.quizzes.submit', $quiz->id) }}" id="quizForm" class="quiz-questions">
            @csrf
            @foreach ($quiz->questions as $index => $question)
                <div class="question-card">
                    <div class="question-header">
                        <div class="question-number">Question {{ $index + 1 }}</div>
                        <h3 class="question-text">{{ $question->question }}</h3>
                    </div>
                    
                    <div class="options-list">
                        @foreach ($question->options as $option)
                            <div class="option-item">
                                <input type="radio"
                                       name="question_{{ $question->id }}"
                                       value="{{ $option->id }}"
                                       class="option-input"
                                       id="option_{{ $option->id }}">
                                <label for="option_{{ $option->id }}" class="option-label">
                                    <span class="option-marker"></span>
                                    <span class="option-text">{{ $option->option_text }}</span>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
            
            <!-- Submit Button -->
            <div class="quiz-footer">
                <button type="submit" class="submit-btn btn-primary" id="submitQuizBtn">
                    <i class="fas fa-paper-plane me-2"></i> Submit Quiz
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Confirmation Modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center p-5">
                <div class="confirmation-icon">
                    <i class="fas fa-question-circle"></i>
                </div>
                <h4 class="modal-title mt-3">Are you sure you want to submit?</h4>
                <p class="text-muted mt-2">You won't be able to change your answers after submission</p>
                <div class="d-flex justify-content-center mt-4 gap-3">
                    <button type="button" class="btn btn-secondary text-light px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary px-4" id="confirmSubmit">Confirm Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Timer functionality
        const duration = {{ $quiz->duration }};
        let totalSeconds = duration * 60;
        const timerDisplay = document.getElementById('quizTimer');
        const timerPath = document.getElementById('timer-path');
        const circumference = 2 * Math.PI * 15.9155;
        
        function updateTimer() {
            const mins = Math.floor(totalSeconds / 60).toString().padStart(2, '0');
            const secs = (totalSeconds % 60).toString().padStart(2, '0');
            timerDisplay.textContent = `${mins}:${secs}`;
            
            // Update circular progress
            const remainingPercent = (totalSeconds / (duration * 60)) * 100;
            const dashoffset = circumference * (remainingPercent / 100);
            timerPath.setAttribute('stroke-dasharray', `${circumference - dashoffset} ${dashoffset}`);
            
            // Change color based on remaining time
            if (totalSeconds <= 10) {
                timerPath.classList.add('timer-critical');
                timerDisplay.classList.add('text-danger', 'pulse');
            } else if (totalSeconds <= 60) {
                timerPath.classList.add('timer-warning');
                timerPath.classList.remove('timer-critical');
                timerDisplay.classList.remove('text-danger', 'pulse');
                timerDisplay.classList.add('text-warning');
            } else {
                timerPath.classList.remove('timer-warning', 'timer-critical');
                timerDisplay.classList.remove('text-danger', 'text-warning', 'pulse');
            }
            
            if (--totalSeconds < 0) {
                clearInterval(timerInterval);
                document.getElementById('quizForm').submit();
            }
        }
        
        const timerInterval = setInterval(updateTimer, 1000);
        updateTimer(); // Initial call
        
        // Progress tracking
        const questions = document.querySelectorAll('[name^="question_"]');
        const progressBar = document.getElementById('quizProgressBar');
        const progressPercentage = document.getElementById('progressPercentage');
        const questionGroups = new Set();
        
        questions.forEach(input => questionGroups.add(input.name));
        const totalQuestions = questionGroups.size;
        
        function updateProgress() {
            const answered = new Set();
            document.querySelectorAll('.option-input:checked').forEach(el => answered.add(el.name));
            const progress = Math.round((answered.size / totalQuestions) * 100);
            
            progressBar.style.width = `${progress}%`;
            progressPercentage.textContent = progress;
            
            // Change progress bar color
            progressBar.className = 'progress-fill';
            if (progress < 30) {
                progressBar.classList.add('progress-low');
            } else if (progress < 70) {
                progressBar.classList.add('progress-medium');
            } else {
                progressBar.classList.add('progress-high');
            }
        }
        
        document.querySelectorAll('.option-input').forEach(input => {
            input.addEventListener('change', updateProgress);
        });
        
        // Submit confirmation
        const submitBtn = document.getElementById('submitQuizBtn');
        const confirmBtn = document.getElementById('confirmSubmit');
        const confirmationModal = new bootstrap.Modal('#confirmationModal');
        
        submitBtn.addEventListener('click', function(e) {
            e.preventDefault();
            confirmationModal.show();
        });
        
        confirmBtn.addEventListener('click', function() {
            document.getElementById('quizForm').submit();
        });
    });


document.addEventListener('DOMContentLoaded', function () {
    let isQuizSubmitted = false;

    // منع مغادرة الصفحة
    window.addEventListener('beforeunload', function (e) {
        if (!isQuizSubmitted) {
            e.preventDefault();
            e.returnValue = '';
        }
    });

    // عند الضغط على تأكيد الإرسال
    document.getElementById('confirmSubmit').addEventListener('click', function () {
        isQuizSubmitted = true;
    });

    // منع الاختصارات
    window.addEventListener('keydown', function (e) {
        if (
            !isQuizSubmitted &&
            !['INPUT', 'TEXTAREA'].includes(e.target.tagName) &&
            (
                e.key === 'F5' ||
                (e.ctrlKey && ['r', 'R', 'w', 'u'].includes(e.key)) ||
                (e.ctrlKey && e.shiftKey && e.key.toLowerCase() === 'i')
            )
        ) {
            e.preventDefault();
            alert("You can't leave or refresh the quiz until you submit.");
        }
    });

    // منع كليك يمين
    document.addEventListener('contextmenu', function (e) {
        if (!isQuizSubmitted) {
            e.preventDefault();
        }
    });
});


</script>

<style>
    :root {
        --purple: #6a0dad;
        --purple-light: #9c27b0;
        --purple-lighter: #e1bee7;
        --purple-dark: #4a148c;
    }
    
    .bg-purple {
        background-color: var(--purple) !important;
    }
    
    .bg-purple-light {
        background-color: var(--purple-lighter) !important;
    }
    
    .text-purple {
        color: var(--purple) !important;
    }
    
    .btn-purple {
        background-color: var(--purple);
        color: white;
        border-color: var(--purple);
    }
    
    .btn-purple:hover {
        background-color: var(--purple-dark);
        border-color: var(--purple-dark);
        color: white;
    }
    
    /* Main Container */
    .quiz-container {
        max-width: 800px;
        margin: 0 auto;
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }
    
    /* Quiz Header */
    .quiz-header {
        padding: 2rem;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-bottom: 1px solid #eee;
    }
    
    .quiz-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--purple-dark);
        margin-bottom: 0.5rem;
    }
    
    .quiz-meta .badge {
        font-size: 0.9rem;
        padding: 0.5rem 0.8rem;
        border-radius: 50px;
    }
    
    /* Timer Styles */
   .quiz-timer {
    position: fixed;
    top: 80px;
    right: 20px;
    z-index: 9999;
    background: #fff;
    padding: 10px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}
    
    .timer-circle {
        width: 80px;
        height: 80px;
        position: relative;
    }
    
    .timer-svg {
        width: 100%;
        height: 100%;
        transform: rotate(-90deg);
    }
    
    .timer-circle-bg {
        fill: none;
        stroke: #f0f0f0;
        stroke-width: 2.5;
    }
    
    .timer-circle-fill {
        fill: none;
        stroke: var(--purple);
        stroke-width: 2.5;
        stroke-linecap: round;
        transition: all 1s linear;
    }
    
    .timer-critical {
        stroke: #e74a3b !important;
    }
    
    .timer-warning {
        stroke: #f6c23e !important;
    }
    
    .timer-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--purple-dark);
    }
    
    /* Progress Bar */
    .quiz-progress {
        margin-top: 1.5rem;
    }
    
    .progress-track {
        height: 8px;
        background: #f0f0f0;
        border-radius: 4px;
        overflow: hidden;
    }
    
    .progress-fill {
        height: 100%;
        border-radius: 4px;
        transition: width 0.6s ease;
        background: var(--purple);
    }
    
    .progress-low {
        background: #e74a3b;
    }
    
    .progress-medium {
        background: #f6c23e;
    }
    
    .progress-high {
        background: #1cc88a;
    }
    
    .progress-label {
        font-size: 0.9rem;
        color: #6c757d;
    }
    
    .progress-percent {
        font-weight: 600;
        color: var(--purple);
    }
    
    /* Questions Section */
    .quiz-questions {
        padding: 2rem;
    }
    
    .question-card {
        background: #fff;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        border: 1px solid #eee;
        transition: all 0.3s ease;
    }
    
    .question-card:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        border-color: #ddd;
    }
    
    .question-header {
        margin-bottom: 1.5rem;
    }
    
    .question-number {
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--purple);
        margin-bottom: 0.5rem;
    }
    
    .question-text {
        font-size: 1.2rem;
        font-weight: 600;
        color: #2c3e50;
        line-height: 1.4;
    }
    
    /* Options Styling */
    .options-list {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }
    
    .option-item {
        position: relative;
    }
    
    .option-input {
        position: absolute;
        opacity: 0;
    }
    
    .option-label {
        display: flex;
        align-items: center;
        padding: 1rem 1.25rem;
        background: #f8f9fa;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .option-label:hover {
        background: #e9ecef;
    }
    
    .option-marker {
        width: 20px;
        height: 20px;
        border: 2px solid #adb5bd;
        border-radius: 50%;
        margin-right: 1rem;
        flex-shrink: 0;
        position: relative;
        transition: all 0.2s ease;
    }
    
    .option-input:checked ~ .option-label {
        background: #f3e5f5;
        border-color: var(--purple);
    }
    
    .option-input:checked ~ .option-label .option-marker {
        border-color: var(--purple);
        background-color: var(--purple);
    }
    
    .option-input:checked ~ .option-label .option-marker::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 10px;
        height: 10px;
        background: white;
        border-radius: 50%;
    }
    
    .option-text {
        font-size: 1rem;
        color: #495057;
    }
    
    /* Quiz Footer */
    .quiz-footer {
        padding-top: 2rem;
        margin-top: 2rem;
        border-top: 1px solid #eee;
        text-align: center;
    }
    
    .submit-btn {
        background: var(--purple);
        color: white;
        border: none;
        padding: 0.75rem 2rem;
        font-size: 1rem;
        font-weight: 600;
        border-radius: 50px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(106, 13, 173, 0.2);
    }
    
    .submit-btn:hover {
        background: var(--purple-dark);
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(106, 13, 173, 0.3);
    }
    
    /* Confirmation Modal */
    .confirmation-icon {
        font-size: 3rem;
        color: var(--purple);
    }
    
    /* Animations */
    .pulse {
        animation: pulse 1s infinite;
    }
    
    @keyframes pulse {
        0% { opacity: 1; }
        50% { opacity: 0.5; }
        100% { opacity: 1; }
    }
    
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .quiz-header {
            padding: 1.5rem;
        }
        
        .quiz-title {
            font-size: 1.5rem;
        }
        
        .timer-circle {
            width: 70px;
            height: 70px;
        }
        
        .quiz-questions {
            padding: 1.5rem;
        }
    }
</style>
@include('student.layout.script') {{-- Include JS --}}

    @include('student.layout.footer')
    <!-- Scripts -->
   <!-- Add in head or before closing body tag -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>