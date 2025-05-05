@extends('teacher.layout.app') 

@section('content') 
<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="row">
      <div class="col-12 col-xl-8 mb-4 mb-xl-0">
        <h3 class="font-weight-bold">Welcome,  {{ $user->firstname }} {{ $user->secname }}
          {{ $user->thirdname }} {{ $user->lastname }}  </h3>
    </div>
     
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6 grid-margin stretch-card">
    <div class="card tale-bg">
      <div class="card-people ">
        <img src="{{ asset('dash-front/images/dashboard/people.png') }}" alt="people">
        <div class="weather-info">
          <div class="">
            <div>
              <h2 class="mb-2 font-weight-normal">
                <i class="icon-sun mr-2"></i>{{ $temperature }}<sup>C</sup>
              </h2>
            </div>
            <div class="ml-2">
              <h4 class="location font-weight-normal">{{ $cityName }}</h4>
              <h6 class="font-weight-normal">{{ $countryName }}</h6>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6 grid-margin transparent">
    <div class="row">
      
      <div class="col-md-6 mb-4 stretch-card transparent">
        <div class="card  card-tale hover-scale" style="cursor: pointer;">
            <div class="card-body d-flex align-items-center">
                <!-- Icon Container with Background -->
                <div class="col-auto p-3 me-1 position-relative">
                    <div class="icon-container bg-opacity-10 rounded-circle ">
                        <i class="fa-solid fa-book text-white fs-1" style="font-size: 4rem !important;"></i>
                    </div>
                </div>
    
                <!-- Text Content -->
                <div class="col text-end pe-4">
                    <h2 class="display-4 fw-bold text-white mb-0">{{ $subjectName }}</h2>
                    <p class="text-uppercase text-white mb-0 fs-5 letter-spacing-1">Subject</p>
                </div>
            </div>
        </div>
    </div>



      <div class="col-md-6 mb-4 stretch-card transparent">
        <div class="card card-light-blue hover-scale" style="cursor: pointer;">
            <div class="card-body d-flex align-items-center">
                <!-- Icon Container with Background -->
                <div class="col-auto p-3 me-1 position-relative">
                    <div class="icon-container bg-opacity-10 rounded-circle ">
                        <i class="fa-solid fa-tasks text-white fs-1" style="font-size: 4rem !important;"></i>
                    </div>
                </div>
    
                <!-- Text Content -->
                <div class="col text-end pe-4">
                    <h2 class="display-4 fw-bold text-white mb-0">{{ $assignmentsCount }}</h2>
                    <p class="text-uppercase text-white mb-0 fs-5 letter-spacing-1">AssignmentS</p>
                </div>
            </div>
        </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 mb-4 stretch-card transparent">
      <div class="card card-dark-blue hover-scale" style="cursor: pointer;">
          <div class="card-body d-flex align-items-center">
              <!-- Icon Container with Background -->
              <div class="col-auto p-3 me-1 position-relative">
                  <div class="icon-container bg-opacity-10 rounded-circle ">
                      <i class="fa-solid  fa-graduation-cap text-white fs-1" style="font-size: 4rem !important;"></i>
                  </div>
              </div>
  
              <!-- Text Content -->
              <div class="col text-end pe-4">
                  <h2 class="display-4 fw-bold text-white mb-0">{{ $studentsCount  }}</h2>
                  <p class="text-uppercase text-white mb-0 fs-5 letter-spacing-1">Students</p>
              </div>
          </div>
      </div>
  </div>



  <div class="col-md-6 mb-4 stretch-card transparent">
    <div class="card card-light-danger hover-scale" style="cursor: pointer;">
        <div class="card-body d-flex align-items-center">
            <!-- Icon Container with Background -->
            <div class="col-auto p-3 me-1 position-relative">
                <div class="icon-container bg-opacity-10 rounded-circle ">
                    <i class="fa-solid fa-question-circle text-white fs-1" style="font-size: 4rem !important;"></i>
                </div>
            </div>

            <!-- Text Content -->
            <div class="col text-end pe-4">
                <h2 class="display-4 fw-bold text-white mb-0">{{ $quizzesCount  }}</h2>
                <p class="text-uppercase text-white mb-0 fs-5 letter-spacing-1">Quizzes</p>
            </div>
        </div>
    </div>
</div>
    
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card position-relative">
      <div class="card-body">
        <div id="detailedReports" class="carousel slide detailed-report-carousel position-static pt-2" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
             
        

<div class="row">
  <div class="col-md-8 grid-margin stretch-card">
    <div class="col-md-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title"><i class="fa-solid fa-calendar-days"></i> Calendar</h4>
          <div id="calendar"></div>
        </div>
      </div>
    </div>

      
    </div>
  <div class="col-md-4 grid-margin stretch-card">
                  <div class="card">
                      <div class="card-body">
                          <h4 class="card-title">To Do Lists</h4>
                          <div class="add-items d-flex mb-0 mt-2">
                            <input type="text" class="form-control todo-list-input"  placeholder="Add new task">
                            <button class="add btn btn-icon text-primary todo-list-add-btn bg-transparent"><i class="icon-circle-plus"></i></button>
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