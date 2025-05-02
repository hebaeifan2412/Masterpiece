{{-- filepath: c:\Users\Orange\Desktop\MasterPiece\School-Management-System\resources\views\admin\layout\app.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.layout.style') {{-- Include CSS --}}
</head>

<body>
    <div class="container-scroller">
        <!-- Navbar -->
        @include('admin.layout.navbar')

        <div class="container-fluid page-body-wrapper">
            <!-- Sidebar -->
            @include('admin.layout.sidebar')

            <!-- Main Content -->
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content') {{-- Yield for page-specific content --}}
                </div>
                <!-- Footer -->
               
            </div>
        </div>
    </div>
    @include('admin.layout.script') {{-- Include JS --}}

    @include('admin.layout.footer')
    <!-- Scripts -->
   
</body>

</html>