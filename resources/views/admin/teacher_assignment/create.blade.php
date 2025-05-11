@extends('admin.layout.app')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">Assign Teacher to Class:  {{ $classProfile->grade->name }} - Section {{ $classProfile->section }}</h3>

    
    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.class.assign-teacher.store', $classProfile->id) }}">
                @csrf

                <div class="mb-3">
                    <label for="subject_id" class="form-label">Choose Subject</label>
                    <select name="subject_id" id="subject_id" class="form-select" required>
                        <option value="">-- Select Subject --</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                                {{ $subject->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="teacher_id" class="form-label">Choose Teacher</label>
                    <select name="teacher_id" id="teacher_id" class="form-select" required>
                        <option value="">-- Select Teacher --</option>
                        @foreach($availableTeachers as $teacher)
                            <option value="{{ $teacher->id }}">
                                {{ $teacher->user->firstname }} {{ $teacher->user->lastname }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-check-circle me-1"></i> Assign Teacher
                </button>
            </form>
        </div>
    </div>

    {{-- قائمة المعلمين المعينين حالياً --}}
    @if($classProfile->teachers && $classProfile->teachers->count())
        <div class="card mt-4 shadow-sm">
            <div class="card-header bg-light fw-bold">
                Assigned Teachers
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    @foreach($classProfile->teachers as $assigned)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $assigned->user->firstname }} {{ $assigned->user->lastname }}
                            <form method="POST" action="{{ route('admin.class.assign-teacher.unassign', [$classProfile->id, $assigned->id]) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Unassign this teacher?')">
                                    <i class="fas fa-user-minus"></i>
                                </button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
</div>
@endsection
