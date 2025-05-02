@extends('student.layout.app') 

@section('content')
<div class="container mt-4">
    <h2 class="mb-4"> My Courses</h2>

    <div class="row">
        @forelse($courses as $course)
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm hover-scale">
                    <div class="card-body">
                        <h5 class="card-title">- {{ $course->subject->name }}</h5>
                        <p class="card-text">
                            {{ Str::limit($course->description, 100) }}
                        </p>
                    
                        <ul class="list-unstyled mb-3">
                            <li> <i class="fas fa-chalkboard-teacher  me-1 text-primary "></i> Teacher: {{ $course->teacher->user->firstname }} {{ $course->teacher->user->secname }}
                                {{ $course->teacher->user->thirdname }} {{ $course->teacher->user->lastname }}
                            </li>
                            <li>   <i class="fa-solid fa-file-lines me-1  text-primary"></i> Quizzes: {{ $course->quizzes_count }}</li>
                            <li> <i class="fas fa-tasks me-1  text-primary"></i> Assignments: {{ $course->assignments_count }}</li>
                         
                        </ul>
                    
                        {{-- <a href="{{ route('student.courses.show', $course->id) }}" class="btn btn-primary">View Course</a> --}}
                    </div>
                    
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">No courses found for your class.</div>
            </div>
        @endforelse
    </div>

</div>
@endsection
