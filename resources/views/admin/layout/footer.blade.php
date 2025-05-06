<footer class="footer">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
      <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2025.</span>
      <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">  <i class="ti-heart text-danger ml-1"></i></span>
    </div>
  </footer>
<script src="{{ asset('dash-front/js/dashboard.js') }}"></script>
 <script src="{{ asset('dash-front/js/Chart.roundedBarCharts.js') }}"></script>
 @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            confirmButtonColor: '#3085d6',
        });
    </script>

@endif
@if ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            html: `{!! implode('<br>', $errors->all()) !!}`,
            confirmButtonColor: '#d33',
        });
    </script>
@endif