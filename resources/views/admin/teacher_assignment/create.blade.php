@extends('admin.layout.app')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">Assign Teacher to Class: Grade {{ $classProfile->grade->name }} - Section {{ $classProfile->section }}</h3>

    {{-- عرض التنبيهات --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- نموذج اختيار المادة --}}
    <form method="GET" action="{{ route('admin.class.assign-teacher', $classProfile->id) }}" class="mb-4">
        <div class="mb-3">
            <label for="subject_id" class="form-label">Choose Subject</label>
            <select name="subject_id" id="subject_id" class="form-select" required onchange="this.form.submit()">
                <option value="">-- Select Subject --</option>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}" {{ $subjectId == $subject->id ? 'selected' : '' }}>
                        {{ $subject->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    {{-- نموذج تعيين المعلم --}}
    @if($teachers->count())
        <form method="POST" action="{{ route('admin.class.assign-teacher.store', $classProfile->id) }}">
            @csrf
            <input type="hidden" name="subject_id" value="{{ $subjectId }}">

            <div class="mb-3">
                <label for="teacher_id" class="form-label">Choose Teacher</label>
                <select name="teacher_id" id="teacher_id" class="form-select" required>
                    <option value="">-- Select Teacher --</option>
                    @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}">
                            {{ $teacher->user->firstname }} {{ $teacher->user->lastname }} — {{ $teacher->subject->name ?? '' }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-check-circle me-1"></i> Assign
            </button>
        </form>
    @elseif($subjectId)
        <div class="alert alert-warning mt-3">No teachers found for this subject.</div>
    @endif

    {{-- قائمة المعلمين المعينين حالياً --}}
    @if($classProfile->teachers && $classProfile->teachers->count())
        <hr>
        <h5 class="mt-4">Assigned Teachers</h5>
        <ul class="list-group">
            @foreach($classProfile->teachers as $assigned)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $assigned->user->firstname }} {{ $assigned->user->lastname }} — {{ $assigned->subject->name ?? 'N/A' }}
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
    @endif
</div>
@endsection
