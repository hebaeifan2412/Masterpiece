@csrf
<div class="row">
    <div class="col-md-6">
        <label>National ID</label>
        <input type="text" name="national_id" class="form-control" value="{{ old('national_id', $student->national_id ?? '') }}" {{ isset($student) ? 'readonly' : '' }}>
    </div>
    <div class="col-md-6">
        <label>User</label>
        <select name="user_id" class="form-control">
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ isset($student) && $student->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-6">
        <label>Class</label>
        <select name="class_id" class="form-control">
            @foreach($classes as $class)
                <option value="{{ $class->id }}" {{ isset($student) && $student->class_id == $class->id ? 'selected' : '' }}>
                    {{ $class->grade->name ?? '' }} {{ $class->section }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label>Date of Birth</label>
        <input type="date" name="date_of_birth" class="form-control" value="{{ old('date_of_birth', $student->date_of_birth ?? '') }}">
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-3">
        <label>First Name</label>
        <input type="text" name="firstname" class="form-control" value="{{ old('firstname', $student->firstname ?? '') }}">
    </div>
    <div class="col-md-3">
        <label>Second Name</label>
        <input type="text" name="secname" class="form-control" value="{{ old('secname', $student->secname ?? '') }}">
    </div>
    <div class="col-md-3">
        <label>Third Name</label>
        <input type="text" name="thirdname" class="form-control" value="{{ old('thirdname', $student->thirdname ?? '') }}">
    </div>
    <div class="col-md-3">
        <label>Last Name</label>
        <input type="text" name="lastname" class="form-control" value="{{ old('lastname', $student->lastname ?? '') }}">
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-6">
        <label>Gender</label>
        <select name="gender" class="form-control">
            <option value="male" {{ old('gender', $student->gender ?? '') == 'male' ? 'selected' : '' }}>Male</option>
            <option value="female" {{ old('gender', $student->gender ?? '') == 'female' ? 'selected' : '' }}>Female</option>
        </select>
    </div>
    <div class="col-md-6">
        <label>Status</label>
        <select name="student_status" class="form-control">
            <option value="active" {{ old('student_status', $student->student_status ?? '') == 'active' ? 'selected' : '' }}>Active</option>
            <option value="graduated" {{ old('student_status', $student->student_status ?? '') == 'graduated' ? 'selected' : '' }}>Graduated</option>
            <option value="on_leave" {{ old('student_status', $student->student_status ?? '') == 'on_leave' ? 'selected' : '' }}>On Leave</option>
        </select>
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-4">
        <label>Address</label>
        <input type="text" name="address" class="form-control" value="{{ old('address', $student->address ?? '') }}">
    </div>
    <div class="col-md-4">
        <label>Father's Phone</label>
        <input type="text" name="father_phone" class="form-control" value="{{ old('father_phone', $student->father_phone ?? '') }}">
    </div>
    <div class="col-md-4">
        <label>Mother's Phone</label>
        <input type="text" name="mother_phone" class="form-control" value="{{ old('mother_phone', $student->mother_phone ?? '') }}">
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-6">
        <label>Mother's Name</label>
        <input type="text" name="mother_name" class="form-control" value="{{ old('mother_name', $student->mother_name ?? '') }}">
    </div>
</div>

<div class="mt-3">
    <button class="btn btn-success" type="submit">{{ $buttonText ?? 'Save' }}</button>
</div>
