@extends('teacher.layout.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">
            <i class="fas fa-tasks me-2"></i> Quizzes Management
        </h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#quizCreateModal">
            <i class="fas fa-plus me-1"></i> Create New Quiz
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
            <h5 class="mb-0"><i class="fas fa-list-ol me-2"></i> Your Quizzes</h5>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Title</th>
                            <th>class</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Status</th>
                            <th>Questions</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($quizzes as $quiz)
                        <tr>
                            <td class="ps-4 fw-bold">{{ $quiz->title }}</td>
                            <td class="ps-4 fw-bold">   {{ $quiz->classProfile->grade->name }} - Section {{ $quiz->classProfile->section }}</td>

                            <td>{{ \Carbon\Carbon::parse($quiz->start_time)->format('M d, Y H:i') }}</td>
                            <td>{{ \Carbon\Carbon::parse($quiz->end_time)->format('M d, Y H:i') }}</td>
                            <td>
                                <span class="badge 
                                    @if($quiz->status == 'active') bg-success
                                    @elseif($quiz->status == 'upcoming') bg-warning text-dark
                                    @else bg-secondary
                                    @endif">
                                    {{ ucfirst($quiz->status) }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-primary rounded-pill">
                                    {{ $quiz->number_of_questions }}
                                </span>
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('teacher.quizzes.questions.index', $quiz->id) }}" 
                                       class="btn btn-sm btn-primary"
                                       data-bs-toggle="tooltip" title="Manage Questions">
                                        <i class="fas fa-question-circle"></i>
                                    </a>
                                    
                                    <a href="{{ route('teacher.quizzes.edit', $quiz->id) }}" class="btn btn-sm btn-secondary text-light"
                                       data-bs-toggle="tooltip" title="Edit Quiz">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    
                                    <form method="POST" action="{{ route('teacher.quizzes.destroy', $quiz->id) }}" 
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm  ld"
                                                onclick="return confirm('Are you sure you want to delete this quiz?')"
                                                data-bs-toggle="tooltip" title="Delete Quiz">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                <i class="fas fa-info-circle me-2"></i> No quizzes found. Create your first quiz!
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('teacher.quizzes.create')

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