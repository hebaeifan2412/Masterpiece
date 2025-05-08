@extends('admin.layout.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Teachers & Subjects for Class: Grade {{ $classProfile->grade->name }} - Section {{ $classProfile->section }}</h2>
    <div class="mt-4">
        <a href="{{ route('admin.class.assign-teacher', ['class' => $classProfile->id]) }}"
            class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Assign New Teacher
         </a>
         
    </div>
    <div class="card">
        <div class="card-body">
            @if ($classProfile->teachers && $classProfile->teachers->count())
                @foreach($classProfile->teachers as $teacher)
                    <div class="mb-2">
                        {{ $teacher->user->firstname }} {{ $teacher->user->lastname }}
                    </div>
                @endforeach
            @else
                <p class="text-muted">No teachers assigned to this class.</p>
            @endif
        </div>
    </div>
</div>
@endsection
