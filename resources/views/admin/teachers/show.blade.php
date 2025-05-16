@extends('admin.layout.app')

@section('content')
    <div class="container pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">Teacher Profile</h3>
                    </div>

                    <div class="card-body">
                        @php
                            $imagePath = $teacherProfile->user->image
                                ? asset('storage/' . $teacherProfile->user->image)
                                : asset('image/user.jpg');
                        @endphp

                        <div class="row align-items-center mb-4">
                            <!-- Profile Picture - Left Side -->
                            <div class="col-md-4 text-center">
                                <div class="position-relative d-inline-block">

                                    <img src="{{ $imagePath }}" alt="Profile Picture" class="rounded-circle shadow"
                                        style="width: 180px; height: 180px; object-fit: cover; border: 5px solid #f8f9fa;">
                                    <div
                                        class="position-absolute bottom-0 end-0 bg-primary rounded-circle p-2 border border-3 border-white">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Information - Right Side -->
                            <div class="col-md-8">
                                <div class="d-flex flex-column">
                                    <h2 class="mb-2">
                                        {{ $teacherProfile->user->firstname }} {{ $teacherProfile->user->secname }}
                                        {{ $teacherProfile->user->thirdname }} {{ $teacherProfile->user->lastname }}
                                    </h2>

                                    <p class="text-muted mb-2">
                                        <i class="fas fa-envelope me-2"></i>{{ $teacherProfile->user->email }}
                                    </p>

                                    <span class="badge bg-primary text-light fs-6 align-self-start">
                                        <i class="fas fa-book me-1"></i> {{ $teacherProfile->subject->name }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <h5 class="text-primary"><i class="fas fa-venus-mars me-2"></i>Gender</h5>
                                    <p class="ps-4">{{ ucfirst($teacherProfile->gender) }}</p>
                                </div>

                                <div class="mb-3">
                                    <h5 class="text-primary"><i class="fas fa-graduation-cap me-2"></i>Qualification</h5>
                                    <p class="ps-4">{{ $teacherProfile->qualification }}</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <h5 class="text-primary"><i class="fas fa-birthday-cake me-2"></i>Date of Birth</h5>
                                    <p class="ps-4">{{ $teacherProfile->dob }}</p>
                                </div>

                                <div class="mb-3">
                                    <h5 class="text-primary"><i class="fas fa-calendar-alt me-2"></i>Joining Date</h5>
                                    <p class="ps-4">{{ $teacherProfile->joining_date }}</p>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="mb-4">
                            <h4 class="text-primary mb-3"><i class="fas fa-chalkboard-teacher me-2"></i>Classes Taught</h4>
                            @if ($teacherProfile->classes->isNotEmpty())
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach ($teacherProfile->classes as $class)
                                        <span class="badge bg-light text-dark border p-2 fs-6">
                                            
                                            <i class="fas fa-door-open text-primary me-1"></i>Grade {{ $class->grade->id }}
                                            - {{ $class->section }}
                                        </span>
                                    @endforeach
                                </div>
                            @else
                                <div class="alert alert-primary">
                                    <i class="fas fa-info-circle me-2"></i> No classes assigned yet.
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="card-footer bg-light text-end">
                        <a href="{{ route('admin.teacher_profiles.index') }}" class="btn btn-outline-secondary me-2">
                            <i class="fas fa-arrow-left me-1"></i>
                        </a>
                        <a href="{{ route('admin.teacher_profiles.edit', $teacherProfile->id) }}" class="btn btn-primary">
                            <i class="fas fa-edit "></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
        }

        .card-header {
            border-radius: 15px 15px 0 0 !important;
            padding: 1.5rem;
        }

        .badge {
            padding: 0.5em 0.75em;
            font-weight: 500;
        }

        h5.text-primary {
            font-size: 1.1rem;
            font-weight: 600;
        }

        hr {
            opacity: 0.15;
        }
    </style>
@endsection
