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
         
        

<div class="row">
  <div class="col-md-8 grid-margin stretch-card">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title"><i class="fa-solid fa-calendar-days"></i> Calendar</h4>
          <div id="calendar"></div>        </div>
      </div>
    </div>

      
    </div>
  <div class="col-md-4 grid-margin stretch-card">
                  <div class="card">
                      <div class="card-body">
                         <div class="add-items d-flex mb-0 mt-2">
                              <input type="text" class="form-control todo-list-input"  placeholder="Add new task">
                              <button class="add btn btn-icon text-primary todo-list-add-btn bg-transparent"><i class="icon-circle-plus"></i></button>
                          </div>
                          <h4 class="card-title">To Do Lists</h4>
                          <div class="list-wrapper pt-2">
                              <ul class="d-flex flex-column-reverse todo-list todo-list-custom">
                                  
                              </ul>
        </div>
       
                      </div>
                  </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="card shadow-sm">
      <div class="card-header bg-primary text-white">
        Student Gender Distribution
      </div>
      <div class="card-body">
        <!-- Canvas element for the chart -->
        <div style="position: relative; height: 250px; width: 100%;">
          <canvas id="genderChart"></canvas>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card shadow-sm ">  <!-- Added shadow-sm and h-100 here -->
      <div class="card-header bg-primary text-white">
        Students by Grade
      </div>
      <div class="card-body">
        <canvas id="gradeChart" height="100" width="200"></canvas>
      </div>
    </div>
  </div>
</div>


</div>
@endsection

@push('scripts')
<script>
  function renderGenderChart() {
  fetch("{{ route('admin.charts.gender') }}")
    .then(res => res.json())
    .then(data => {
      const ctx = document.getElementById('genderChart').getContext('2d');
      new Chart(ctx, {
        type: 'pie',
        data: {
          labels: data.labels,
          datasets: [{
            data: data.values,
            backgroundColor: ['#36A2EB', '#FF6384']
          }]
        },
        options: {
          responsive: true,
          plugins: {
            legend: { position: 'bottom' },
            title: {
              display: true,
              text: 'Student Gender Distribution'
            }
          }
        }
      });
    })
    .catch(error => {
      console.error('Error:', error);
      document.getElementById('genderChart').closest('.card-body').innerHTML =
        '<div class=\"alert alert-danger\">Failed to load chart</div>';
    });
}

document.addEventListener('DOMContentLoaded', renderGenderChart);
</script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js"></script>

@endpush
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    fetch("{{ route('admin.charts.grades') }}")
        .then(res => res.json())
        .then(chart => {
            const ctx = document.getElementById('gradeChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: chart.labels,
                    datasets: [{
                        label: 'Number of Students',
                        data: chart.data,
                        backgroundColor: '#4747A1'
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: { display: true, text: 'Students' }
                        },
                        x: {
                            title: { display: true, text: 'Grade' }
                        }
                    }
                }
            });
        });
});
</script>
<!-- FullCalendar CSS & JS -->
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

