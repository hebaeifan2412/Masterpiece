@extends('admin.layout.app') 

@section('content') 
<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="row">
      <div class="col-12 col-xl-8 mb-4 mb-xl-0">
        <h3 class="font-weight-bold">Welcome, {{ $user->firstname }} {{ $user->secname }}
          {{ $user->thirdname }} {{ $user->lastname }} </h3>
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
                        <i class="fa-solid fa-person-chalkboard text-white fs-1" style="font-size: 4rem !important;"></i>
                    </div>
                </div>
    
                <!-- Text Content -->
                <div class="col text-end pe-4">
                    <h2 class="display-4 fw-bold text-white mb-0">{{ $teachersCount }}</h2>
                    <p class="text-uppercase text-white mb-0 fs-5 letter-spacing-1">Total Teachers</p>
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
                        <i class="fa-solid fa-graduation-cap text-white fs-1" style="font-size: 4rem !important;"></i>
                    </div>
                </div>
    
                <!-- Text Content -->
                <div class="col text-end pe-4">
                    <h2 class="display-4 fw-bold text-white mb-0">{{ $studentsCount }}</h2>
                    <p class="text-uppercase text-white mb-0 fs-5 letter-spacing-1">Total Students</p>
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
                      <i class="fa-solid fa-school text-white fs-1" style="font-size: 4rem !important;"></i>
                  </div>
              </div>
  
              <!-- Text Content -->
              <div class="col text-end pe-4">
                  <h2 class="display-4 fw-bold text-white mb-0">{{ $classesCount  }}</h2>
                  <p class="text-uppercase text-white mb-0 fs-5 letter-spacing-1">classes</p>
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
                    <i class="fa-solid fa-book text-white fs-1" style="font-size: 4rem !important;"></i>
                </div>
            </div>

            <!-- Text Content -->
            <div class="col text-end pe-4">
                <h2 class="display-4 fw-bold text-white mb-0">{{ $subjectsCount  }}</h2>
                <p class="text-uppercase text-white mb-0 fs-5 letter-spacing-1">Subject</p>
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
              {{-- <div class="row">
                <div class="col-md-12 col-xl-3 d-flex flex-column justify-content-start">
                  <div class="ml-xl-4 mt-3">
                  <p class="card-title">Detailed Reports</p>
                    <h1 class="text-primary">$34040</h1>
                    <h3 class="font-weight-500 mb-xl-4 text-primary">North America</h3>
                    <p class="mb-2 mb-xl-0">The total number of sessions within the date range. It is the period time a user is actively engaged with your website, page or app, etc</p>
                  </div>  
                  </div>
                <div class="col-md-12 col-xl-9">
                  <div class="row">
                    <div class="col-md-6 border-right">
                      <div class="table-responsive mb-3 mb-md-0 mt-3">
                        <table class="table table-borderless report-table">
                          <tr>
                            <td class="text-muted">Illinois</td>
                            <td class="w-100 px-0">
                              <div class="progress progress-md mx-4">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                            <td><h5 class="font-weight-bold mb-0">713</h5></td>
                          </tr>
                          <tr>
                            <td class="text-muted">Washington</td>
                            <td class="w-100 px-0">
                              <div class="progress progress-md mx-4">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                            <td><h5 class="font-weight-bold mb-0">583</h5></td>
                          </tr>
                          <tr>
                            <td class="text-muted">Mississippi</td>
                            <td class="w-100 px-0">
                              <div class="progress progress-md mx-4">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                            <td><h5 class="font-weight-bold mb-0">924</h5></td>
                          </tr>
                          <tr>
                            <td class="text-muted">California</td>
                            <td class="w-100 px-0">
                              <div class="progress progress-md mx-4">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                            <td><h5 class="font-weight-bold mb-0">664</h5></td>
                          </tr>
                          <tr>
                            <td class="text-muted">Maryland</td>
                            <td class="w-100 px-0">
                              <div class="progress progress-md mx-4">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                            <td><h5 class="font-weight-bold mb-0">560</h5></td>
                          </tr>
                          <tr>
                            <td class="text-muted">Alaska</td>
                            <td class="w-100 px-0">
                              <div class="progress progress-md mx-4">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                            <td><h5 class="font-weight-bold mb-0">793</h5></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <div class="col-md-6 mt-3">
                      <canvas id="north-america-chart"></canvas>
                      <div id="north-america-legend"></div>
                    </div>
                  </div> --}}
                </div>
              </div>
        

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
                          <div class="list-wrapper pt-2">
                              <ul class="d-flex flex-column-reverse todo-list todo-list-custom">
                                  <li>
                                      <div class="form-check form-check-flat">
                                          <label class="form-check-label">
                                              <input class="checkbox" type="checkbox">
                                              Meeting with Urban Team
                                          </label>
                                      </div>
                                      <i class="remove ti-close"></i>
                                  </li>
                                  <li class="completed">
                                      <div class="form-check form-check-flat">
                                          <label class="form-check-label">
                                              <input class="checkbox" type="checkbox" checked>
                                              Duplicate a project for new customer
                                          </label>
                                      </div>
                                      <i class="remove ti-close"></i>
                                  </li>
                                  <li>
                                      <div class="form-check form-check-flat">
                                          <label class="form-check-label">
                                              <input class="checkbox" type="checkbox">
                                              Project meeting with CEO
                                          </label>
                                      </div>
                                      <i class="remove ti-close"></i>
                                  </li>
                                  <li class="completed">
                                      <div class="form-check form-check-flat">
                                          <label class="form-check-label">
                                              <input class="checkbox" type="checkbox" checked>
                                              Follow up of team zilla
                                          </label>
                                      </div>
                                      <i class="remove ti-close"></i>
                                  </li>
                                  <li>
                                      <div class="form-check form-check-flat">
                                          <label class="form-check-label">
                                              <input class="checkbox" type="checkbox">
                                              Level up for Antony
                                          </label>
                                      </div>
                                      <i class="remove ti-close"></i>
                                  </li>
                              </ul>
        </div>
        <div class="add-items d-flex mb-0 mt-2">
                              <input type="text" class="form-control todo-list-input"  placeholder="Add new task">
                              <button class="add btn btn-icon text-primary todo-list-add-btn bg-transparent"><i class="icon-circle-plus"></i></button>
                          </div>
                      </div>
                  </div>
  </div>
</div>
@endsection