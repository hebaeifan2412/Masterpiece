{{-- filepath: c:\Users\Orange\Desktop\MasterPiece\School-Management-System\resources\views\auth\login.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('dash-front/vendors/feather/feather.css') }}">
  <link rel="stylesheet" href="{{ asset('dash-front/vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('dash-front/vendors/css/vendor.bundle.base.css') }}">
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('dash-front/css/vertical-layout-light/style.css') }}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('dash-front/images/favicon.png') }}" />

  
  <style>
    .auth-bg-section {
        min-height: 51vh;
        position: relative;
        overflow: hidden;
        
    }
    .r{
        border-radius: 16px !important; /* Increased rounding */
        transition: all 0.3s ease;
    }
  
    .logo-animation {
        animation: float 3s ease-in-out infinite;
    }
  
    .hover-scale {
        transition: transform 0.3s ease;
    }
  
    .hover-scale:hover {
        transform: scale(1.05);
    }
  
    .floating-label-group {
        position: relative;
        margin-bottom: 1.5rem;
    }
  
    .floating-label {
        position: absolute;
        top: 18px;
        left: 45px;
        color: #6c757d;
        transition: all 0.3s ease;
        pointer-events: none;
    }
  
    .floating-label-group .form-control-lg {
        padding-left: 45px;
        height: 56px;
        border-radius: 12px;
        border: 2px solid #e9ecef;
        transition: all 0.3s ease;
    }
  
    .floating-label-group .form-control-lg:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }
  
    .floating-label-group .form-control-lg:focus ~ .floating-label,
    .floating-label-group .form-control-lg:not(:placeholder-shown) ~ .floating-label {
        top: -10px;
        left: 30px;
        font-size: 12px;
        color: #6366f1;
        background: white;
        padding: 0 5px;
    }
  
    .icon-wrapper {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
    }

  
    
  </style>

</head>

<body >
  <div class="container-scroller " >
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0 " style="background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);">
            <div class="row w-100 mx-5 " >
                <!-- Left Side with Logo Animation -->
                <div class="col-lg-4 d-flex align-items-center  justify-content-center auth-bg-section" 
                    >
                  
                        <img src="{{ asset('dash-front/images/logo.png') }}" alt="logo" 
                            class="img-fluid hover-scale" 
                            style="max-width: 280px; filter: drop-shadow(0 10px 15px rgba(0,0,0,0.1));">
                    
                </div>

                <!-- Right Side with Form -->
                <div class="col-lg-6 d-flex align-items-center justify-content-center r ">
                    <div class="auth-form-container text-center bg-light p-5 rounded-4 shadow r" 
                        style="width: 100%; max-width: 500px; transform: translateY(-20px);">
                        <div class="auth-header mb-4">
                            <h2 class="text-gradient-primary fw-bold">Sign In</h2>
                        </div>
                        
                        <form method="POST" action="{{ route('signin') }}">
                            @csrf
                            
                            <!-- Email Input with Floating Label -->
                            <div class="form-group floating-label-group border-2">
                                <input type="email" id="email" name="email" 
                                    class="form-control form-control-lg " 
                                    placeholder=" " value="{{ old('email') }}" required autofocus>
                                <label class="floating-label font-weight-bolder text-primary">Email Address</label>
                                <div class="icon-wrapper">
                                    <i class="mdi mdi-email-outline"></i>
                                </div>
                                @error('email')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Password Input with Floating Label -->
                            <div class="form-group floating-label-group mt-4">
                                <input type="password" id="password" name="password" 
                                    class="form-control form-control-lg" 
                                    placeholder=" " required>
                                <label class="floating-label font-weight-bolder text-primary">Password</label>
                                <div class="icon-wrapper">
                                    <i class="mdi mdi-lock-outline"></i>
                                </div>
                                @error('password')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            

                            <!-- Submit Button -->
                            <div class="mt-5">
                                <button type="submit" 
                                    class="btn btn-lg btn-primary w-50 btn-icon-text shadow-sm">
                                    <i class="mdi mdi-login-variant btn-icon-prepend"></i>
                                    Sign In
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{ asset('dash-front/vendors/js/vendor.bundle.base.js') }}"></script>
  <!-- inject:js -->
  <script src="{{ asset('dash-front/js/off-canvas.js') }}"></script>
  <script src="{{ asset('dash-front/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('dash-front/js/template.js') }}"></script>
  <script src="{{ asset('dash-front/js/settings.js') }}"></script>
  <script src="{{ asset('dash-front/js/todolist.js') }}"></script>
  <!-- endinject -->
</body>

</html>