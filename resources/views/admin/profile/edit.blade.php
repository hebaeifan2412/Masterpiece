@extends('admin.layout.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold text-primary">Edit Profile</h2>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Back to Dashboard
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card shadow-sm border-0 overflow-hidden">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0"><i class="fas fa-user-cog me-2"></i> Admin Information</h5>
                </div>
                
                <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="card-body p-4">
                    @csrf
                    @method('patch')

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

                    <div class="mb-4">
                        <label class="form-label fw-bold">Profile Image</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-image"></i></span>
                            <input type="file" name="image" class="form-control">
                        </div>
                        @if($admin->image)
                            <div class="mt-2">
                                <img src="{{ asset('storage/'.$admin->image) }}" alt="Profile Image" width="100" class="img-thumbnail">
                            </div>
                        @endif
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
@endsection