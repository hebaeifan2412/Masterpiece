
@section('content')
<div class="container">
    <h2>Edit Student</h2>

    <form action="{{ route('admin.students.update', $student->national_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>First Name</label>
            <input type="text" name="firstname" value="{{ $student->firstname }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Last Name</label>
            <input type="text" name="lastname" value="{{ $student->lastname }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Gender</label>
            <select name="gender" class="form-control">
                <option value="male" {{ $student->gender == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ $student->gender == 'female' ? 'selected' : '' }}>Female</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Date of Birth</label>
            <input type="date" name="date_of_birth" value="{{ $student->date_of_birth }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Address</label>
            <textarea name="address" class="form-control">{{ $student->address }}</textarea>
        </div>

        <div class="mb-3">
            <label>Class</label>
            <select name="class_id" class="form-control">
                @foreach($classes as $class)
                    <option value="{{ $class->id }}" {{ $student->class_id == $class->id ? 'selected' : '' }}>
                        Grade {{ $class->grade->name ?? '' }} - Section {{ $class->section }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Student</button>
    </form>
</div>
@endsection