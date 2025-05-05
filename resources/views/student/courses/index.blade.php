@extends('student.layout.app') 

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">My Subjects</h2>

    <div class="row">
        @forelse($teachers as $teacher)
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm hover-scale">
                    <div class="card-body">
                        <h5 class="card-title text-primary">{{ $teacher->subject->name ?? 'Unknown Subject' }}</h5>

                        <ul class="list-unstyled mb-3">
                            <li>
                                <i class="fas fa-chalkboard-teacher me-1 text-primary"></i>
                                Teacher: {{ $teacher->user->firstname }} {{ $teacher->user->secname }}
                                {{ $teacher->user->thirdname }} {{ $teacher->user->lastname }}
                            </li>
                            <li>
                                <i class="fa-solid fa-file-lines me-1 text-primary"></i>
                                Quizzes: {{ $teacher->quiz_count ?? 0 }}
                            </li>
                            <li>
                                <i class="fas fa-tasks me-1 text-primary"></i>
                                Assignments: {{ $teacher->assignment_count ?? 0 }}
                            </li>
                        </ul>

                        {{-- <a href="{{ route('student.subjects.show', $teacher->id) }}" class="btn btn-primary">View Details</a> --}}
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">No subjects found for your class.</div>
            </div>
        @endforelse
    </div>
</div>
@endsection
