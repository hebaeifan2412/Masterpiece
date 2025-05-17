@extends('teacher.layout.app')

@section('content')
    <div class="container">
        <h2>Edit Quiz</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('teacher.quizzes.update', $quiz->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Quiz Title</label>
                <input type="text" name="title" class="form-control" value="{{ $quiz->title }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Assign to Classes</label>
                @foreach ($classess as $class)
                    <div class="form-check ms-3">
                        <input class="form-check-input" type="checkbox" name="class_ids[]" value="{{ $class->id }}"
                            id="class{{ $class->id }}" {{ $quiz->classes->contains($class->id) ? 'checked' : '' }}>
                        <p class="form-check" for="class{{ $class->id }}">
                            {{ $class->grade->name }} - Section {{ $class->section }}
                        </p>
                    </div>
                @endforeach
            </div>


            <div class="mb-3">
                <label class="form-label">Duration (minutes)</label>
                <input type="number" name="duration" class="form-control" value="{{ $quiz->duration }}" required>
            </div>
<div class="mb-3">
    <label class="form-label">Quiz Date</label>
    <input type="date" name="quiz_date" class="form-control"
        value="{{ \Carbon\Carbon::parse($quiz->start_time)->format('Y-m-d') }}" required>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Start Time</label>
        <input type="time" name="start_hour" class="form-control"
            value="{{ \Carbon\Carbon::parse($quiz->start_time)->format('H:i') }}" required>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">End Time</label>
        <input type="time" name="end_hour" class="form-control"
            value="{{ \Carbon\Carbon::parse($quiz->end_time)->format('H:i') }}" required>
    </div>
</div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select" required>
                    <option value="show" {{ $quiz->status == 'show' ? 'selected' : '' }}>Show</option>
                    <option value="hide" {{ $quiz->status == 'hide' ? 'selected' : '' }}>Hide</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Quiz</button>
        </form>
    </div>
@endsection
