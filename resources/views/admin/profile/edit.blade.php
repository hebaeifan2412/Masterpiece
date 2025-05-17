@extends('admin.layout.app')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="d-flex justify-content-between align-items-center mb-4">
                {{-- <h2 class="fw-bold text-primary">Edit Profile</h2> --}}
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary text-light">
                    <i class="fas fa-arrow-left me-1"></i> 
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif --}}

            <div class="card shadow-sm border-0 overflow-hidden">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0"><i class="fas fa-user-cog me-2"></i> Admin Information</h5>
                </div>
                
                <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="card-body p-4">
                    @csrf
                    @method('patch')

                    <!-- Profile Image Upload (Hidden by default) -->
                    <input type="file" name="image" id="profileImageInput" class="d-none" accept="image/*">

                    <!-- Profile Image Display -->
                    <div class="d-flex align-items-start mb-4">
                        <div class="me-4">
                            <label for="profileImageInput" style="cursor: pointer;">
                                <div class="position-relative">
                                    @if($admin->image)
                                        <img src="{{ asset('storage/'.$admin->image) }}" 
                                             alt="Profile Image" 
                                             width="100" 
                                             class="rounded-circle border border-3 border-primary object-fit-cover"
                                             style="width: 100px; height: 100px;">
                                    @else
                                        <div class="rounded-circle border border-3 border-primary d-flex align-items-center justify-content-center bg-light" 
                                             style="width: 100px; height: 100px;">
                                            <i class="fas fa-user fa-3x text-muted"></i>
                                        </div>
                                    @endif
                                    <div class="position-absolute bottom-0 end-0 bg-primary rounded-circle p-2">
                                        <i class="fas fa-camera text-white"></i>
                                    </div>
                                </div>
                            </label>
                        </div>
                        <div class="flex-grow-1">
                            <div class="row g-3 mb-4">
                                <div class="col-md-3">
                                    <label class="form-label fw-bold">First Name</label>
                                    <input type="text" name="firstname" class="form-control" 
                                           value="{{ old('firstname', $admin->firstname) }}" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-bold">Second Name</label>
                                    <input type="text" name="secname" class="form-control" 
                                           value="{{ old('secname', $admin->secname) }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-bold">Third Name</label>
                                    <input type="text" name="thirdname" class="form-control" 
                                           value="{{ old('thirdname', $admin->thirdname) }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-bold">Last Name</label>
                                    <input type="text" name="lastname" class="form-control" 
                                           value="{{ old('lastname', $admin->lastname) }}" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Phone Number</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                <input type="text" name="phone_no" class="form-control" 
                                       value="{{ old('phone_no', $admin->phone_no) }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" name="email" class="form-control" 
                                       value="{{ old('email', $admin->email) }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center border-top pt-4">
                        <a href="{{ route('admin.password.edit') }}" class="btn btn-outline-primary">
                            <i class="fas fa-key me-1"></i> Change Password
                        </a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save me-1"></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Preview image when selected
    document.getElementById('profileImageInput').addEventListener('change', function(e) {
        if (e.target.files && e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function(event) {
                const imgElement = document.querySelector('.rounded-circle[alt="Profile Image"]');
                if (imgElement) {
                    imgElement.src = event.target.result;
                } else {
                    const placeholder = document.querySelector('.rounded-circle .fa-user');
                    if (placeholder) {
                        placeholder.parentElement.innerHTML = `<img src="${event.target.result}" alt="Profile Image" class="rounded-circle border border-3 border-primary object-fit-cover" style="width: 100px; height: 100px;">`;
                    }
                }
            }
            reader.readAsDataURL(e.target.files[0]);
        }
    });
</script>

@endsection