@extends('admin.layout.app')

@section('content')
<div class="container">
    <h2>Create New User</h2>

    <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Role --}}
        <div class="mb-3">
            <label for="role_id" class="form-label">Role</label>
            <select name="role_id" id="role_id" class="form-control @error('role_id') is-invalid @enderror" required>
                <option value="">-- Select Role --</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                        {{ ucfirst($role->name) }}
                    </option>
                @endforeach
            </select>
            @error('role_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Email --}}
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" 
                   class="form-control @error('email') is-invalid @enderror" 
                   value="{{ old('email') }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Phone --}}
        <div class="mb-3">
            <label for="phone_no" class="form-label">Phone Number</label>
            <input type="text" name="phone_no" id="phone_no"
                   class="form-control @error('phone_no') is-invalid @enderror" 
                   maxlength="10" value="{{ old('phone_no') }}">
            @error('phone_no')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Password --}}
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" 
                   class="form-control @error('password') is-invalid @enderror"
                   placeholder="Min 8 chars, upper & lower case, number" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Image --}}
        <div class="mb-3">
            <label for="image" class="form-label">User Image (optional)</label>
            <input type="file" name="image" id="image" 
                   class="form-control @error('image') is-invalid @enderror" accept="image/*">
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Common Name Fields --}}
        <div class="row">
            <div class="col">
                <label>First Name:</label>
                <input type="text" name="firstname" class="form-control" value="{{ old('firstname') }}">
            </div>
            <div class="col">
                <label>Second Name:</label>
                <input type="text" name="secname" class="form-control" value="{{ old('secname') }}">
            </div>
            <div class="col">
                <label>Third Name:</label>
                <input type="text" name="thirdname" class="form-control" value="{{ old('thirdname') }}">
            </div>
            <div class="col">
                <label>Last Name:</label>
                <input type="text" name="lastname" class="form-control" value="{{ old('lastname') }}">
            </div>
        </div>

        {{-- Gender --}}
        <div class="mb-3">
            <label for="gender" class="form-label">Gender</label>
            <select name="gender" id="gender" 
                    class="form-control @error('gender') is-invalid @enderror">
                <option value="">-- Select Gender --</option>
                <option value="male" {{ old('gender')=='male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ old('gender')=='female' ? 'selected' : '' }}>Female</option>
            </select>
            @error('gender')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Student-Specific Fields --}}
        <div id="studentFields" style="display: none;">
            <div class="mb-3">
                <label for="national_id" class="form-label">National ID</label>
                <input type="text" name="national_id" id="national_id"
                       class="form-control @error('national_id') is-invalid @enderror"
                       value="{{ old('national_id') }}">
                @error('national_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="class_id" class="form-label">Class</label>
                <select name="class_id" id="class_id" 
                        class="form-control @error('class_id') is-invalid @enderror">
                    <option value="">-- Select Class --</option>
                    @foreach($ClassProfile as $class)
                    <option value="{{ $class->id }}">
                        Grade {{ $class->grade->name ?? 'N/A' }} - Section {{ $class->section }}
                    </option>                    @endforeach
                </select>
                @error('class_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="date_of_birth" class="form-label">Date of Birth</label>
                <input type="date" name="date_of_birth" id="date_of_birth"
                       class="form-control @error('date_of_birth') is-invalid @enderror"
                       value="{{ old('date_of_birth') }}">
                @error('date_of_birth')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea name="address" id="address" 
                          class="form-control @error('address') is-invalid @enderror" rows="2">{{ old('address') }}</textarea>
                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="father_phone" class="form-label">Father's Phone</label>
                <input type="text" name="father_phone" id="father_phone"
                       class="form-control @error('father_phone') is-invalid @enderror" 
                       maxlength="10" value="{{ old('father_phone') }}">
                @error('father_phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="mother_phone" class="form-label">Mother's Phone</label>
                <input type="text" name="mother_phone" id="mother_phone"
                       class="form-control @error('mother_phone') is-invalid @enderror" 
                       maxlength="10" value="{{ old('mother_phone') }}">
                @error('mother_phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="mother_name" class="form-label">Mother's Name</label>
                <input type="text" name="mother_name" id="mother_name"
                       class="form-control @error('mother_name') is-invalid @enderror"
                       value="{{ old('mother_name') }}">
                @error('mother_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Teacher-Specific Fields --}}
        <div id="teacherFields" style="display: none;">
            <div class="mb-3">
                <label for="qualification" class="form-label">Qualification</label>
                <input type="text" name="qualification" id="qualification"
                       class="form-control @error('qualification') is-invalid @enderror"
                       value="{{ old('qualification') }}">
                @error('qualification')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="dob" class="form-label">Date of Birth</label>
                <input type="date" name="dob" id="dob"
                       class="form-control @error('dob') is-invalid @enderror"
                       value="{{ old('dob') }}">
                @error('dob')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="joining_date" class="form-label">Joining Date</label>
                <input type="date" name="joining_date" id="joining_date"
                       class="form-control @error('joining_date') is-invalid @enderror"
                       value="{{ old('joining_date') }}">
                @error('joining_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="leave_date" class="form-label">Leave Date (optional)</label>
                <input type="date" name="leave_date" id="leave_date"
                       class="form-control @error('leave_date') is-invalid @enderror"
                       value="{{ old('leave_date') }}">
                @error('leave_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Create User</button>
    </form>
</div>

{{-- JavaScript to toggle student/teacher fields based on selected role --}}
<script>
    function toggleFields() {
        let roleId = document.getElementById('role_id').value;
        document.getElementById('studentFields').style.display = (roleId == 2) ? 'block' : 'none';
        document.getElementById('teacherFields').style.display = (roleId == 3) ? 'block' : 'none';
    }

    document.getElementById('role_id').addEventListener('change', toggleFields);
    window.addEventListener('load', toggleFields);
</script>
@endsection
