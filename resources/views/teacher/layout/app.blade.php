<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>School Teacher</title>
    @include('teacher.layout.style') {{-- Include CSS --}}
</head>

<body>
    <div class="container-scroller">
        <!-- Navbar -->
        @include('teacher.layout.navbar')

        <div class="container-fluid page-body-wrapper">
            <!-- Sidebar -->
            @include('teacher.layout.sidebar')

            <!-- Main Content -->
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content') {{-- Yield for page-specific content --}}
                </div>
                <!-- Footer -->
               
            </div>
        </div>
    </div>
    @include('teacher.layout.script') {{-- Include JS --}}

    @include('teacher.layout.footer')
    <!-- Scripts -->
   <!-- Add in head or before closing body tag -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>