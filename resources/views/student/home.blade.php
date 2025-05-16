@extends('student.layout.app')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Welcome, {{ $studentName }} </h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Class Name -->
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card card-tale hover-scale" style="cursor: default;">
                <div class="card-body d-flex align-items-center">
                    <div class="col-auto p-3 me-1 position-relative">
                        <div class="icon-container bg-opacity-10 rounded-circle">
                            <i class="fa-solid fa-school text-white fs-1"></i>
                        </div>
                    </div>
                    <div class="col text-end pe-4">
                        <h2 class="display-6 fw-bold text-white mb-0">{{ $className }}</h2>
                        <p class="text-uppercase text-white mb-0 fs-5 letter-spacing-1">Your Class</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Courses -->
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card card-light-blue hover-scale">
                <div class="card-body d-flex align-items-center">
                    <div class="col-auto p-3 me-1 position-relative">
                        <div class="icon-container bg-opacity-10 rounded-circle">
                            <i class="fa-solid fa-book-open text-white fs-1"></i>
                        </div>
                    </div>
                    <div class="col text-end pe-4">
                        <h2 class="display-4 fw-bold text-white mb-0">{{ count($teachers) }}</h2>
                        <p class="text-uppercase text-white mb-0 fs-5 letter-spacing-1"> Subjects</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Quizzes -->
        <div class="col-md-6 mb-4 stretch-card transparent">
            <div class="card card-dark-blue hover-scale">
                <div class="card-body d-flex align-items-center">
                    <div class="col-auto p-3 me-1 position-relative">
                        <div class="icon-container bg-opacity-10 rounded-circle">
                            <i class="fa-solid fa-file-lines text-white fs-1"></i>
                        </div>
                    </div>
                    <div class="col text-end pe-4">
                        <h2 class="display-4 fw-bold text-white mb-0">{{ $quizzesCount }}</h2>
                        <p class="text-uppercase text-white mb-0 fs-5 letter-spacing-1">Quizzes Taken</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Average Marks -->
        <div class="col-md-6 mb-4 stretch-card transparent">
            <div class="card card-light-danger hover-scale">
                <div class="card-body d-flex align-items-center">
                    <div class="col-auto p-3 me-1 position-relative">
                        <div class="icon-container bg-opacity-10 rounded-circle">
                            <i class="fa-solid fa-star text-white fs-1"></i>
                        </div>
                    </div>
                    <div class="col text-end pe-4">
                        <h2 class="display-4 fw-bold text-white mb-0">{{ $averageMark }}%</h2>
                        <p class="text-uppercase text-white mb-0 fs-5 letter-spacing-1">Average Mark</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <!-- Dashboard Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0 text-primary">
                    <i class="fas fa-user-graduate me-2"></i> My Info
                </h4>
                <div>
                    <span class="badge bg-primary">
                        <i class="fas fa-id-card me-1"></i> Student
                    </span>
                </div>
            </div>

            <!-- Profile Card -->
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <!-- Profile Picture Column -->
                        <div class="col-md-4 text-center mb-4 mb-md-0">
                            <div class="position-relative d-inline-block">
                                <img src="{{ Auth::user()->image != null ? asset('storage/' . Auth::user()->image) : asset('image/' . 'user.jpg') }}"
                                    class="img-thumbnail  border-primary"
                                    style=" object-fit: cover;" alt="Student Image">
                              
                            </div>
                            <div class="mt-3">
                                <span class="badge bg-light text-dark">
                                    <i
                                        class="fas fa-{{ $student->gender == 'male' ? 'mars' : 'venus' }} me-1 text-{{ $student->gender == 'male' ? 'primary' : 'danger' }}"></i>
                                    {{ ucfirst($student->gender) }}
                                </span>
                            </div>
                        </div>

                        <!-- Personal Information Column -->
                        <div class="col-md-8">

                            <div class="bg-light p-3 rounded mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-envelope  text-primary me-2 fs-5"></i>
                                    <div>
                                        <strong>Email</strong>  - {{ $student->user->email }}
                                    </div>
                                </div>
                            </div>
                            <div class="bg-light p-3 rounded mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-id-card  text-primary me-2 fs-5"></i>
                                    <div>
                                       <strong>National Id </strong>- {{ $student->national_id }}
                                    </div>
                                </div>
                            </div>
                            <div class="bg-light p-3 rounded mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-birthday-cake text-primary fs-5 me-1"></i>
                                    <div>
                                       <strong> Date Of Birth</strong> - 
                                        {{ $student->date_of_birth }}
                                    </div>
                                </div>
                            </div>
                            <!-- Address Box -->
                            <div class="bg-light p-3 rounded mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-map-marker-alt text-primary me-2 fs-5"></i>
                                    <div>
                                        <strong>Address</strong> - <span class="mb-0">{{ $student->address }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-light p-3 rounded mb-3">
                                <div class="d-flex align-items-center">
                                     <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                            <i class="fas fa-female text-primary fs-4"></i>
                                        </div>
                                    <div>
                                      <strong>Mother</strong>   - {{ $student->mother_name }}<p class="mb-0"> {{ $student->mother_phone }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-light p-3 rounded mb-3">
                                <div class="d-flex align-items-center">
                                     <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                            <i class="fas fa-male text-primary fs-4"></i>
                                        </div>
                                    <div>
                                       <strong>Father</strong>   - {{ $student->user->secname }}<p class="mb-0"> {{ $student->father_phone }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">
                    
                    
                </div>


            </div>
        </div>
    </div>

    <style>
        .card {
            border-radius: 0.5rem;
        }

        .badge {
            padding: 0.5em 0.8em;
            font-weight: 500;
            border-radius: 0.375rem;
        }

        .bg-light {
            background-color: #f8f9fa !important;
        }

        .shadow-sm {
            box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .075) !important;
        }

        .bg-opacity-10 {
            background-color: rgba(13, 110, 253, 0.1) !important;
        }
    </style>
@endsection
@push('scripts')
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'en',
                height: 550,

            });

            calendar.render();
        });
    </script>
@endpush
