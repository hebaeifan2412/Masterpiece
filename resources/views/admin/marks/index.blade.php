@extends('admin.layout.app')

@section('content')
@php use Illuminate\Support\Str; @endphp

<div class="container py-4">
    <h2 class="mb-4"><i class="fa-solid fa-marker me-3"></i>Student Quizzes Marks</h2>

    <form method="GET" action="" class="row g-3 mb-4">
        <div class="col-md-4">
            <label class="form-label">Filter by class</label>
            <select name="class_id" class="form-select" onchange="this.form.submit()">
                <option value="">All Classes</option>
                @foreach ($classess as $class)
                    <option value="{{ $class->id }}" {{ request('class_id') == $class->id ? 'selected' : '' }}>
                        {{ $class->grade->name }} - {{ $class->section }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label">Search Student Name</label>
            <input type="text" name="search" class="form-control" placeholder="Enter student name..."
                   value="{{ request('search') }}">
        </div>
        <div class="col-md-2 align-self-end">
            <button type="submit" class="btn btn-primary w-100">Apply</button>
        </div>
    </form>

    @foreach ($classess as $class)
        @php
            if (request('class_id') && request('class_id') != $class->id) {
                continue;
            }
        @endphp

        @foreach ($class->quizzes as $quiz)
            @php
                $filteredStudents = $class->students->filter(function ($student) {
                    $fullName = $student->user->firstname . ' ' . $student->user->lastname;
                    if (request('search')) {
                        return str_contains(Str::lower($fullName), Str::lower(request('search')));
                    }
                    return true;
                });
            @endphp

            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        {{ $class->grade->name }} - {{ $class->section }} - {{ $quiz->title }}
                    </h5>
                </div>

                <div class="card-body">
                    @if ($filteredStudents->isEmpty())
                        <div class="alert alert-info">No students found for the given filter.</div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>National ID</th>
                                        <th>Mark</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($filteredStudents->values() as $index => $student)
                                        @php
                                            $fullName = $student->user->firstname . ' ' . $student->user->lastname;
                                            $studentMark = $student->marks->where('quiz_id', $quiz->id)->first();
                                            $totalQuestions = $quiz->questions->count();
                                            $obtainedMark = $studentMark->marks ?? 0;
                                        @endphp
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $fullName }}</td>
                                            <td>{{ $student->national_id }}</td>
                                            <td>{{ $obtainedMark }} / {{ $totalQuestions }}</td>
                                            <td><span class="text-muted">View only</span></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    @endforeach
</div>
@endsection
