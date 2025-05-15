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

    <!-- Optional Calendar + Todo List Section (for students) -->
    <div class="row">
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><i class="fa-solid fa-calendar-days"></i> Calendar</h4>
                    <div id="calendar"></div>
                </div>
            </div>
        </div>

        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">To Do Lists</h4>
                    <div class="add-items d-flex mb-0 mt-2">
                        <input type="text" class="form-control todo-list-input" placeholder="Add new task">
                        <button class="add btn btn-icon text-primary todo-list-add-btn bg-transparent"><i
                                class="icon-circle-plus"></i></button>
                    </div>
                    <div class="list-wrapper pt-2">
                        <ul class="d-flex flex-column-reverse todo-list todo-list-custom">
                          
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function () {
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

