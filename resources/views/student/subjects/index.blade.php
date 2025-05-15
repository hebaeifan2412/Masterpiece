@extends('student.layout.app')

@section('content')
    <div class="container py-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-dark mb-0"> <i class="fa-solid fa-book  menu-icon"></i>
                My Subjects</h2>
            <div class="badge bg-primary-soft text-primary rounded-pill">
                {{ count($teachers) }} {{ Str::plural('Subject', count($teachers)) }}
            </div>
        </div>

        <!-- Subjects Grid -->
        <div class="row g-4">
            @forelse($teachers as $teacher)
                <div class="col-lg-6 col-md-6">
                    <div class="card subject-card h-100 border-0 shadow-sm hover-shadow transition-all">
                        <div class="card-body p-4">
                            <!-- Subject Header -->
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h5 class="card-title fw-bold text-dark mb-1">
                                        {{ $teacher->subject->name ?? 'Unknown Subject' }}
                                    </h5>
                                    <p class="text-muted small mb-0">
                                        <i class="fas fa-book-open me-1"></i>
                                        {{ $teacher->subject->code ?? 'N/A' }}
                                    </p>
                                </div>
                                <div class="teacher-info d-flex align-items-center mb-3">
                                    <div class="avatar-sm me-3">
                                        <div class="avatar-title bg-primary-soft text-primary rounded-circle">
                                            <i class="fas fa-user-tie"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-semibold">{{ $teacher->user->firstname }}
                                            {{ $teacher->user->lastname }}</h6>
                                        <small class="text-muted">Teacher</small>
                                    </div>
                                </div>
                                {{-- <span class="badge bg-light text-primary rounded-pill">
                                {{ $teacher->class->name ?? 'No Class' }}
                            </span> --}}
                            </div>

                            <!-- Teacher Info -->


                            <!-- Stats -->
                            <div class="subject-stats row g-2 mt-3">
                                <div class="col-6">
                                    <div class="p-3 bg-light-purple rounded text-center">
                                        <div class="d-flex  align-items-center justify-content-center">

                                            <i class="fas fa-file-alt text-light  fs-5 me-2"></i>
                                            <h6 class="mb-0  text-light fw-bold">{{ $teacher->assignment_count ?? 0 }}</h6>
                                        </div>
                                        <small class="text-light">Assignments</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="p-3 bg-light-red rounded text-center">
                                        <div class="d-flex  align-items-center justify-content-center">
                                            <i class="fas fa-question-circle fs-5 text-light me-2"></i>
                                            <h6 class="mb-0 fw-bold  text-light">{{ $teacher->quiz_count ?? 0 }}</h6>
                                        </div>
                                        <small class=" text-light ">Quizzes</small>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="empty-state text-center py-5">
                        <div class="empty-state-icon bg-light-primary text-primary rounded-circle mb-3">
                            <i class="fas fa-book fa-2x"></i>
                        </div>
                        <h4 class="mb-3">No Subjects Found</h4>
                        <p class="text-muted mb-4">You haven't been assigned to any subjects yet.</p>

                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <style>
        .subject-card {
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);

        }

        .hover-shadow {}

        .hover-shadow:hover {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .bg-light-success {
            background-color: rgba(25, 135, 84, 0.1);
        }

        .bg-light-info {
            background-color: rgba(13, 202, 240, 0.1);
        }

        .avatar-title {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
        }
    </style>
@endsection
