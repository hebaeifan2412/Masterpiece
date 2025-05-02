@extends('teacher.layout.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0 fw-bold text-dark">📚 My Classes</h2>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @forelse ($entries as $entry)
        <div class="col">
            <div class="card h-100 border-0 shadow-sm course-card">
                <div class="card-header bg-white py-3 border-bottom">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h5 class="mb-1 text-dark fw-semibold">
                                <i class="fas fa-school me-2 text-primary"></i>
                                 {{ $entry->classProfile->grade->name }} - Section {{ $entry->classProfile->section }}
                            </h5>
                            <small class="text-muted">{{ $subject->name }}</small>
                        </div>
                    </div>
                </div>

                <div class="card-body d-flex flex-column">
                    <div class="mb-3">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-users me-2 text-muted"></i>
                            <span>{{$entry->classProfile
->students->count() }} Students</span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-book me-2 text-muted"></i>
                            <span>Subject: {{ $subject->name }}</span>
                        </div>
                    </div>

                    @if ($entry->classProfile->students->count())
                        <div class="mt-auto">
                            <button class="btn btn-sm btn-primary w-100 mb-2 rounded-pill" 
                                    data-bs-toggle="collapse" 
                                    data-bs-target="#students_{{ $entry->id }}">
                                <i class="fas fa-list me-1"></i> View Students
                            </button>
                        </div>
                    @endif
                </div>

                @if ($entry->classProfile->students->count())
                <div class="collapse" id="students_{{ $entry->id }}">
                    <div class="card-footer bg-light border-0 pt-3">
                        <div class="table-responsive">
                            <table class="table table-sm table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th width="40" class="text-center">#</th>
                                        <th>Student</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($entry->classProfile->students as $index => $student)
                                        <tr>
                                            <td class="text-center fw-bold text-muted">{{ $index + 1 }}</td>
                                            <td>
                                                {{ $student->user->firstname }} {{ $student->user->lastname }}
                                            </td>
                                            <td>{{ $student->user->email }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center py-5">
                    <i class="fas fa-book-open fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">No Classes Assigned</h4>
                    <p class="text-muted mb-0">You are not assigned to any classes yet.</p>
                </div>
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection
