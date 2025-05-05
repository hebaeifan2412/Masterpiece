@extends('admin.layout.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Add New Teacher</h2>

   
     {{-- Validation Errors --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif 

    {{-- Teacher Form --}}
    <div id="teacherForm" >
        <form method="POST" action="{{ route('admin.teacher_profiles.store') }}" enctype="multipart/form-data">
            @csrf

            {{-- Email --}}
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            {{-- Phone --}}
            <div class="mb-3">
                <label for="phone_no" class="form-label">Phone Number</label>
                <input type="text" name="phone_no" class="form-control" maxlength="15">
            </div>

            {{-- Password --}}
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            {{-- Image --}}
            <div class="mb-3">
                <label for="image" class="form-label">Profile Image (optional)</label>
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>

            {{-- Name Fields --}}
            <div class="row mb-3">
                <div class="col"><input type="text" name="firstname" class="form-control" placeholder="First Name"></div>
                <div class="col"><input type="text" name="secname" class="form-control" placeholder="Second Name"></div>
                <div class="col"><input type="text" name="thirdname" class="form-control" placeholder="Third Name"></div>
                <div class="col"><input type="text" name="lastname" class="form-control" placeholder="Last Name"></div>
            </div>

            {{-- Gender --}}
            <div class="mb-3">
                <label class="form-label">Gender</label>
                <select name="gender" class="form-control" required>
                    <option value="">Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>

            {{-- Qualification --}}
            <div class="mb-3">
                <label class="form-label">Qualification</label>
                <input type="text" name="qualification" class="form-control">
            </div>
            {{-- Subject --}}
<div class="mb-3">
    <label for="subject_id" class="form-label">Subject</label>
    <select name="subject_id" id="subject_id" class="form-control" required>
        <option value="">-- Select Subject --</option>
        @foreach ($subjects as $subject)
            <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                {{ $subject->name }}
            </option>
        @endforeach
    </select>
</div>


            {{-- Date of Birth --}}
            <div class="mb-3">
                <label class="form-label">Date of Birth</label>
                <input type="date" name="dob" class="form-control" required>
            </div>

            {{-- Joining Date --}}
            <div class="mb-3">
                <label class="form-label">Joining Date</label>
                <input type="date" name="joining_date" class="form-control" required>
            </div>

            {{-- Leave Date --}}
            <div class="mb-3">
                <label class="form-label">Leave Date (optional)</label>
                <input type="date" name="leave_date" class="form-control">
            </div>

            {{-- Submit --}}
            <div class="text-center">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Create Teacher
                </button>
                <a href="{{ route('admin.teacher_profiles.index') }}" class="btn btn-secondary text-light">Cancel</a>
            </div>
        </form>
    </div>
</div>

{{-- JS to toggle form --}}
<script>
    document.getElementById('showTeacherFormBtn').addEventListener('click', function () {
        document.getElementById('teacherForm').style.display = 'block';
        this.style.display = 'none';
    });
</script>
@endsection
