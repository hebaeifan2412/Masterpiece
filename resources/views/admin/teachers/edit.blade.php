@extends('admin.layout.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">Edit Teacher Profile</h2>
        <a href="{{ route('admin.teacher_profiles.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-1"></i> Back to List
        </a>
    </div>

    <div class="card border-0 shadow-lg rounded-4 p-4">
        <form action="{{ route('admin.teacher_profiles.update', $teacherProfile->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
    <div class="text-center mb-4">
        @php
            $imagePath = $teacherProfile->user->image 
                ? asset('storage/' . $teacherProfile->user->image)
                : asset('image/user.jpg');
        @endphp

        <!-- Hidden input -->
        <input type="file" name="image" id="imageInput" class="d-none" accept="image/*" onchange="document.getElementById('previewImage').src = window.URL.createObjectURL(this.files[0])">

        <!-- Clickable Image -->
        <label for="imageInput" style="cursor: pointer;">
            <img id="previewImage" src="{{ $imagePath }}" 
                 alt="Profile Image" 
                 class="rounded-circle shadow" 
                 style="width: 160px; height: 160px; object-fit: cover; border: 5px solid #f1f1f1;">
            <div class="small text-muted mt-2">Click image to change</div>
        </label>
    </div>

            <h5 class="text-dark mb-3">User Information</h5>
            <div class="row g-4">
                <div class="col-md-3">
                    <label for="firstname" class="form-label">First Name</label>
                    <input type="text" name="firstname" class="form-control" value="{{ old('firstname', $teacherProfile->user->firstname) }}" required>
                </div>
                <div class="col-md-3">
                    <label for="secname" class="form-label">Second Name</label>
                    <input type="text" name="secname" class="form-control" value="{{ old('secname', $teacherProfile->user->secname) }}">
                </div>
                <div class="col-md-3">
                    <label for="thirdname" class="form-label">Third Name</label>
                    <input type="text" name="thirdname" class="form-control" value="{{ old('thirdname', $teacherProfile->user->thirdname) }}">
                </div>
                <div class="col-md-3">
                    <label for="lastname" class="form-label">Last Name</label>
                    <input type="text" name="lastname" class="form-control" value="{{ old('lastname', $teacherProfile->user->lastname) }}" required>
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $teacherProfile->user->email) }}" required>
                </div>
            </div>

            <hr class="my-4">

            <h5 class="text-dark mb-3">Teacher Profile Information</h5>
            <div class="row g-4">
                <div class="col-md-6">
                    <label for="dob" class="form-label">Date of Birth</label>
                    <input type="date" name="dob" class="form-control" value="{{ old('dob', $teacherProfile->dob) }}" required>
                </div>

                <div class="col-md-6">
                    <label for="gender" class="form-label">Gender</label>
                    <select name="gender" class="form-select" required>
                        <option value="male" {{ $teacherProfile->gender == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ $teacherProfile->gender == 'female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="joining_date" class="form-label">Joining Date</label>
                    <input type="date" name="joining_date" class="form-control" value="{{ old('joining_date', $teacherProfile->joining_date) }}" required>
                </div>

                <div class="col-md-6">
                    <label for="leave_date" class="form-label">Leave Date (optional)</label>
                    <input type="date" name="leave_date" class="form-control" value="{{ old('leave_date', $teacherProfile->leave_date) }}">
                </div>

                <div class="col-md-12">
                    <label for="qualification" class="form-label">Qualification</label>
                    <input type="text" name="qualification" class="form-control" value="{{ old('qualification', $teacherProfile->qualification) }}" placeholder="e.g., Master's in Physics">
                </div>

                <div class="col-md-12">
                    <label for="address" class="form-label">Address (optional)</label>
                    <textarea name="address" class="form-control" rows="3">{{ old('address', $teacherProfile->address) }}</textarea>
                </div>

            </div>

            <div class="mt-4 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="fas fa-save me-1"></i> Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
