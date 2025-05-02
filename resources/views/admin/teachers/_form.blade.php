<div class="form-group">
    <label for="user_id">Username</label>
    <select name="user_id" class="form-control" required>
        <option value="">-- Choose User --</option>
        @foreach($users as $user)
            <option value="{{ $user->id }}"
                {{ isset($teacher_profile) && $teacher_profile->user_id == $user->id ? 'selected' : '' }}>
                {{ $user->username }} ({{ $user->email }})
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label>Qualification</label>
    <input type="text" name="qualification" class="form-control"
        value="{{ old('qualification', $teacher_profile->qualification ?? '') }}">
</div>

<div class="form-group">
    <label>Date of Birth</label>
    <input type="date" name="dob" class="form-control"
        value="{{ old('dob', $teacher_profile->dob ?? '') }}">
</div>

<div class="form-group">
    <label>Gender</label>
    <select name="gender" class="form-control">
        <option value="male" {{ old('gender', $teacher_profile->gender ?? '') == 'male' ? 'selected' : '' }}>Male</option>
        <option value="female" {{ old('gender', $teacher_profile->gender ?? '') == 'female' ? 'selected' : '' }}>Female</option>
    </select>
</div>

<div class="form-group">
    <label>Address</label>
    <input type="text" name="address" class="form-control"
        value="{{ old('address', $teacher_profile->address ?? '') }}">
</div>

<div class="form-group">
    <label>Joining Date</label>
    <input type="date" name="joining_date" class="form-control"
        value="{{ old('joining_date', $teacher_profile->joining_date ?? '') }}">
</div>

<div class="form-group">
    <label>Leave Date (Optional)</label>
    <input type="date" name="leave_date" class="form-control"
        value="{{ old('leave_date', $teacher_profile->leave_date ?? '') }}">
</div>

<div class="form-group">
    <label>Profile Picture (Optional)</label>
    <input type="file" name="pic" class="form-control">
</div>
