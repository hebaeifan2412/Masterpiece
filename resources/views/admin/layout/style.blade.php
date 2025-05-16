 <!-- Required meta tags -->
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 <title>School Admin</title>
 <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">

 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
{{-- <link rel="stylesheet" href="{{ asset('dash-front/css/bootstrap.min.css') }}"> --}}
<link rel="stylesheet" href="{{ asset('dash-front/css/vertical-layout-light/style.css') }}"> <!-- plugins:css -->
 <link rel="stylesheet" href="{{ asset('dash-front/vendors/feather/feather.css') }}">
 <link rel="stylesheet" href="{{ asset('dash-front/vendors/ti-icons/css/themify-icons.css') }}">
 <link rel="stylesheet" href="{{ asset('dash-front/vendors/css/vendor.bundle.base.css') }}">
 <!-- Plugin css for this page -->
 <link rel="stylesheet" href="{{ asset('dash-front/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
 <link rel="stylesheet" href="{{ asset('dash-front/js/select.dataTables.min.css') }}">
 <!-- inject:css -->
 <link rel="stylesheet" href="{{ asset('dash-front/css/vertical-layout-light/style.css') }}"> <!-- endinject -->
 <link rel="shortcut icon" href="{{ asset('dash-front/images/icon.png') }}" />
 
 
 <link href='https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.8/main.min.css' rel='stylesheet' />
 <link href='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.8/main.min.css' rel='stylesheet' />


 <style>
  #calendar .fc-toolbar-title {
    font-size: 3rem;
  }

  #calendar .fc-button {
    font-size: 0.75rem;
    padding: 0.25rem 0.5rem;
    background-color: #4747a1;
  }

  #calendar .fc-daygrid-day-frame {
    padding: 2px;
  }

  #calendar .fc-daygrid-day-number {
    font-size: 1rem;
    font-weight: bold;
    color:#4747a1;
  }
  #calendar .fc-day-today {
    background-color: #c997d9a3 !important; /* Bootstrap success-light */
  }
  #calendar td {
    color: #7c7cdf9e;
  }
  .fc-col-header-cell-cushion{
    color: #4747a1;

  }
  #calendar .fc-scroller-harness {
    padding: 0 !important;
  }

  #calendar {
    font-size: 0.75rem;
    max-height: 400px;
    height: 100%;
  }
  </style>
  