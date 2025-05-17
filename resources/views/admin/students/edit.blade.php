@extends('admin.layout.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center fs-4">
        <h3 class="text-dark text-capitalize ps-3 mb-0">
            <i class="fas fa-user-edit me-2"></i> Edit Student Profile
        </h3>
        <a href="{{ route('admin.students.show',$student->national_id) }}" class="btn btn-secondary text-light me-3 mt-2">
            <i class="fas fa-arrow-left me-1"></i> 
        </a>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-body px-4 pb-4 pt-3">
                   

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

                    <form action="{{ route('admin.students.update', $student->national_id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- الصورة على اليسار -->
                            <div class="col-md-3">
                                <div class="section-card mb-4">
                                    <div class="section-header bd p-3 border-bottom">
                                        <h5 class="mb-0">
                                            <i class="fas fa-image me-2"></i> Profile Image
                                        </h5>
                                    </div>
                                    <div class="section-body p-3 text-center">
                                        @php
                                            $imagePath = $student->user->image 
                                                ? asset('storage/' . $student->user->image)
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
                                </div>
                            </div>
                            
                            <!-- المعلومات الشخصية على اليمين -->
                            <div class="col-md-9">
                                <div class="section-card mb-4">
                                    <div class="section-header bd p-3 border-bottom">
                                        <h5 class="mb-0">
                                            <i class="fas fa-id-card me-2"></i> Personal Information
                                        </h5>
                                    </div>
                                    <div class="section-body p-3">
                                        <div class="row g-3">
                                            @foreach (['firstname', 'secname', 'thirdname', 'lastname'] as $name)
                                            <div class="col-md-3">
                                                <div class="form-floating">
                                                    <input type="text" name="{{ $name }}" class="form-control" value="{{ old($name, $student->user->$name) }}" required>
                                                    <label for="{{ $name }}">{{ ucfirst($name) }}</label>
                                                </div>
                                            </div>
                                            @endforeach

                                            <div class="col-md-4">
                                                <div class="form-floating">
                                                    <input type="email" name="email" class="form-control" value="{{ old('email', $student->user->email) }}" required>
                                                    <label for="email">Email</label>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                               <div class="form-floating">
                                                    <select name="gender" class="form-select" required>
                                                        <option value="male" {{ $student->gender == 'male' ? 'selected' : '' }}>Male</option>
                                                        <option value="female" {{ $student->gender == 'female' ? 'selected' : '' }}>Female</option>
                                                    </select>
                                                    <label for="gender">Gender</label>
                                                </div>
                                            </div>

                                           

                                            <div class="col-md-4">
                                                <div class="form-floating">
                                                    <input type="date" name="date_of_birth" class="form-control" value="{{ $student->date_of_birth }}">
                                                    <label for="date_of_birth">Date of Birth</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="section-card mb-4">
                                    <div class="section-header ld p-3 border-bottom">
                                        <h5 class="mb-0">
                                            <i class="fas fa-graduation-cap me-2"></i> Academic Information
                                        </h5>
                                    </div>
                                    <div class="section-body p-3">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input type="text" name="national_id" class="form-control" value="{{ old('national_id', $student->national_id) }}" readonly>
                                                    <label for="national_id">National ID</label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <select name="class_id" class="form-select" required>
                                                        @foreach($classProfiles as $class)
                                                        <option value="{{ $class->id }}" {{ $student->class_id == $class->id ? 'selected' : '' }}>
                                                            {{ $class->grade->name }} - Section {{ $class->section }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    <label for="class_id">Class</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="section-card mb-4">
                                    <div class="section-header bb p-3 border-bottom">
                                        <h5 class="mb-0">
                                            <i class="fas fa-users me-2"></i> Family Information
                                        </h5>
                                    </div>
                                    <div class="section-body p-3">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <div class="form-floating">
                                                    <textarea name="address" class="form-control" style="height: 80px">{{ old('address', $student->address) }}</textarea>
                                                    <label for="address">Address</label>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-floating">
                                                    <input type="text" name="mother_name" class="form-control" value="{{ old('mother_name', $student->mother_name) }}">
                                                    <label for="mother_name">Mother's Name</label>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-floating">
                                                    <input type="text" name="father_phone" class="form-control" value="{{ old('father_phone', $student->father_phone) }}">
                                                    <label for="father_phone">Father's Phone</label>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-floating">
                                                    <input type="text" name="mother_phone" class="form-control" value="{{ old('mother_phone', $student->mother_phone) }}">
                                                    <label for="mother_phone">Mother's Phone</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary px-5 rounded-pill">
                                        <i class="fas fa-save me-2"></i> Update Student
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection