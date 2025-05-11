@extends('admin.layout.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>
            Teachers & Subjects for:  {{ $classProfile->grade->name }} - Section {{ $classProfile->section }}
        </h2>
        <a href="{{ route('admin.class.assign-teacher', ['class' => $classProfile->id]) }}" 
           class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Assign Teacher
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            @if ($classProfile->teachers && $classProfile->teachers->count())
                <div class="table-responsive">
                    <table class="table table-hover lign-middlea ">
                        <thead class="text-light bg-primary">
                            <tr>
                                <th>Teacher</th>
                                <th>Subjects</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($classProfile->teachers as $teacher)
                                <tr>
                                    <td>
                                        {{ $teacher->user->firstname }} {{ $teacher->user->lastname }}
                                        <br>
                                        <small class="text-muted">{{ $teacher->user->email }}</small>
                                    </td>
                                    <td>
                                        @if($teacher->subjects && $teacher->subjects->count())
                                            <ul class="list-unstyled mb-0">
                                                @foreach($teacher->subjects as $subject)
                                                    <li>{{ $subject->name }}</li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <span class="text-muted">No subjects assigned</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash-alt"></i> Remove
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-primary">
                    <i class="fas fa-info-circle me-2"></i> No teachers have been assigned to this class yet.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection