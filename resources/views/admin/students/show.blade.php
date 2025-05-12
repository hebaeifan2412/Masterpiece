@extends('admin.layout.app')

@section('content')
<div class="container py-4">
    <div class="card border-0 shadow-lg">
        <div class="card-header bg-primary text-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <i class="fas fa-user-graduate me-2"></i> Student Profile
                </h4>
              
            </div>
        </div>

        <div class="card-body p-4">
            @php
                $image = $student->user->image 
                    ? asset('storage/' . $student->user->image)
                    : asset('image/user.jpg');
            @endphp

            <div class="row align-items-center mb-4">
                <div class="col-md-3 text-center">
                    <div class="position-relative d-inline-block">
                        <img src="{{ $image }}" 
                             class="rounded-circle shadow" 
                             style="width: 150px; height: 150px; object-fit: cover; border: 5px solid #f8f9fa;">
                        <div class="position-absolute bottom-0 end-0 bg-primary rounded-circle p-2 border border-3 border-white">
                            <i class="fas fa-user text-white"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <h3 class="mb-2">{{ $student->user->firstname }} {{ $student->user->secname }} {{ $student->user->lastname }}</h3>
                    <div class="d-flex flex-wrap gap-3">
                        <span class="badge bg-light text-dark">
                            <i class="fas fa-envelope text-primary me-1"></i> {{ $student->user->email }}
                        </span>
                        <span class="badge bg-light text-dark">
                            <i class="fas fa-id-card text-primary me-1"></i> {{ $student->national_id }}
                        </span>
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="p-3 bg-light rounded-3 h-100">
                        <h5 class="text-primary mb-3">
                            <i class="fas fa-school me-2"></i> Class Information
                        </h5>
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-graduation-cap text-primary me-3 fs-4"></i>
                            <div>
                                <h6 class="mb-0">Grade</h6>
                                <p class="mb-0">{{ $student->classProfile->grade->name }}</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-chalkboard text-primary me-3 fs-4"></i>
                            <div>
                                <h6 class="mb-0">Section</h6>
                                <p class="mb-0">{{ $student->classProfile->section }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="p-3 bg-light rounded-3 h-100">
                        <h5 class="text-primary mb-3">
                            <i class="fas fa-book me-2"></i> Subjects & Teachers
                        </h5>
                        @forelse ($student->classProfile->teachers as $teacher)
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-book-open text-primary me-3 fs-5"></i>
                                <div>
                                    <h6 class="mb-0">{{ $teacher->subject->name }}</h6>
                                    <p class="mb-0 small">{{ $teacher->user->firstname }} {{ $teacher->user->lastname }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-primary mb-0">
                                <i class="fas fa-info-circle me-2"></i> No subjects assigned
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer bg-light text-end py-3">
            <a href="{{ route('admin.students.index') }}" class="btn btn-outline-secondary me-2">
                <i class="fas fa-arrow-left me-1"></i>
            </a>
            <a href="{{ route('admin.students.edit', $student->national_id) }}" class="btn btn-primary">
                <i class="fas fa-edit me-1"></i> 
            </a>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .card {
        border-radius: 0.5rem;
        overflow: hidden;
    }
    .card-header {
        border-radius: 0;
    }
    .badge {
        padding: 0.5em 0.8em;
        font-weight: 500;
    }
    .bg-light {
        background-color: #f8f9fa!important;
    }
    .rounded-3 {
        border-radius: 0.3rem!important;
    }
</style>
@endsection