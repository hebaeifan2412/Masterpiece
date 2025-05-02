@extends('teacher.layout.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4"> Student Quizess Marks</h2>

    <form method="GET" action="" class="row g-3 mb-4">
        <div class="col-md-4">
            <label class="form-label">Filter by class</label>
            <select name="class_id" class="form-select" onchange="this.form.submit()">
                <option value="">All Classes</option>
                @foreach ($classess as $class)
                    <option value="{{ $class->id }}" {{ request('class_id') == $class->id ? 'selected' : '' }}>
                        {{$class->grade->name }} - {{ $class->section }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label">Search Student Name</label>
            <input type="text" name="search" class="form-control" placeholder="Enter student name..." value="{{ request('search') }}">
        </div>
        <div class="col-md-2 align-self-end">
            <button type="submit" class="btn btn-primary w-100">Apply</button>
        </div>
    </form>

    @foreach ($classess as $class)
        @php
            if (request('class_id') && request('class_id') != $class->id) continue;
        @endphp

        @foreach ($quizzes->where('class_id', $class->id) as $quiz)
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center bg-primary text-light">
                    <h5 class="mb-0">{{ $class->grade->name }} - {{ $quiz->title }}</h5>
                    <span class="badge bg-secondary">{{ $class->students->count() }} Students</span>
                </div>
                <div class="card-body">
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
                                @foreach ($class->students as $index => $student)
                                    @php
                                        $fullName = $student->user->firstname . ' ' . $student->user->lastname;
                                        if (request('search') && !str_contains(Str::lower($fullName), Str::lower(request('search')))) continue;

                                        $studentMark = $student->marks->where('quiz_id', $quiz->id)->first();
                                    @endphp
                                    <tr>
                                        <form action="{{ route('teacher.marks.update') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="class_id" value="{{ $class->id }}">
                                            <input type="hidden" name="student_id" value="{{ $student->national_id }}">
                                            <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $fullName }}</td>
                                            <td>{{ $student->national_id }}</td>
                                            <td class="d-flex align-items-center gap-2">
                                                @php
                                                    $totalQuestions = $quiz->questions->count();
                                                    $obtainedMark = $studentMark->marks ?? 0;
                                                @endphp
                                            
                                                <input type="number" name="marks" class="form-control form-control-sm" required min="0" max="{{ $totalQuestions }}" value="{{ $obtainedMark }}" style="width: 70px;">
                                                
                                                <small class="text-muted">/ {{ $totalQuestions }}</small>
                                            </td>
                                            
                                            <td>
                                                <button type="submit" class="btn btn-sm btn-primary">Save</button>
                                            </td>
                                        </form>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach
    @endforeach
</div>
@endsection
