@extends('admin.layout.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center fs-4">
        <h3 class="text-dark text-capitalize ps-3 mb-0 fw-bold">
            <i class="fas fa-chalkboard-teacher me-2"></i> Register New Teacher
        </h3>
        <a href="{{ route('admin.teacher_profiles.index') }}" class="btn btn-secondary text-light me-3 mt-2">
            <i class="fas fa-arrow-left me-1"></i>
        </a>
    </div>
    
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-body px-4 pb-4 pt-3">
                    <!-- Notification Alerts -->
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        <div>{{ session('success') }}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Validation Errors</strong>
                        </div>
                        <ul class="mb-0 mt-2 ps-3">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <form action="{{ route('admin.teacher_profiles.store') }}" method="POST" enctype="multipart/form-data"
                    class="needs-validation" novalidate>
                        @csrf

                        <!-- Personal Information Section -->
                        <div class="section-card mb-4">
                            <div class="section-header bg-primary p-3 border-bottom">
                                <h5 class="mb-0 text-light">
                                    <i class="fas fa-id-card me-2"></i> Personal Information
                                </h5>
                            </div>
                            <div class="section-body p-3">
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <input type="text" name="firstname" class="form-control" id="firstname" placeholder="First Name" required>
                                            <label for="firstname">First Name <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <input type="text" name="secname" class="form-control" id="secname" placeholder="Second Name" required>
                                            <label for="secname">Second Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <input type="text" name="thirdname" class="form-control" id="thirdname" placeholder="Third Name" required>
                                            <label for="thirdname">Third Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Last Name" required>
                                            <label for="lastname">Last Name <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
                                            <label for="email">Email <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="text" name="phone_no" class="form-control" id="phone_no" placeholder="Phone" maxlength="10" required>
                                            <label for="phone_no">Phone Number</label>
                                            <div class="invalid-feedback">
                                                The phone number must start with 07 and be exactly 10 digits.
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                                            <label for="password">Password <span class="text-danger">*</span></label>
                                       
                                        <div class="invalid-feedback">
                                                Password must be exactly 8 char and have number.
                                            </div> </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <select name="gender" class="form-select" id="gender" required>
                                                <option value=""></option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            </select>
                                            <label for="gender">Gender <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="date" name="dob" class="form-control" id="dob" required>
                                            <label for="dob">Date of Birth <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="image" class="form-label">Profile Image (optional)</label>
                                            <input type="file" name="image" class="form-control" id="image" accept="image/*">
                                            <small class="text-muted">Max 2MB (JPG, PNG, JPEG)</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Professional Information Section -->
                        <div class="section-card mb-4">
                            <div class="section-header bg-light-red p-3 border-bottom">
                                <h5 class="mb-0 text-light">
                                    <i class="fas fa-briefcase me-2"></i> Professional Information
                                </h5>
                            </div>
                            <div class="section-body p-3">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" name="qualification" class="form-control" id="qualification" placeholder="Qualification" required>
                                            <label for="qualification">Qualification <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <select name="subject_id" class="form-select" id="subject_id" required>
                                                <option value=""></option>
                                                @foreach($subjects as $subject)
                                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                                @endforeach
                                            </select>
                                            <label for="subject_id">Subject <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="date" name="joining_date" class="form-control" id="joining_date" required>
                                            <label for="joining_date">Joining Date <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="date" name="leave_date" class="form-control" id="leave_date">
                                            <label for="leave_date">Leave Date (optional)</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information Section -->
                        <div class="section-card mb-4">
                            <div class="section-header bg-light-blue p-3 border-bottom">
                                <h5 class="mb-0 text-light">
                                    <i class="fas fa-address-book me-2"></i> Contact Information
                                </h5>
                            </div>
                            <div class="section-body p-3">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <textarea name="address" class="form-control" id="address" placeholder="Address" style="height: 80px"></textarea>
                                            <label for="address">Address</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-lg btn-primary px-5 rounded-pill">
                                <i class="fas fa-user-plus me-2"></i> Register Teacher
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .section-card {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        overflow: hidden;
    }
    .section-header {
        border-bottom: 1px solid #dee2e6;
    }
    .form-floating > label {
        padding: 0.8rem 1rem;
    }
    .form-control, .form-select {
        border-radius: 6px;
        padding: 0.8rem 1rem;
    }
   
    .bg-info {
        background-color: #17a2b8 !important;
    }
    .bg-secondary {
        background-color: #6c757d !important;
    }
</style>

@endsection
@push('scripts')
    <script>
        // Bootstrap-style client-side validation
        (function() {
            'use strict'
            const forms = document.querySelectorAll('.needs-validation')

            Array.from(forms).forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
@endpush
