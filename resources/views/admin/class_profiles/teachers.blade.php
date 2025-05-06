@extends('admin.layout.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Teachers & Subjects for Class: Grade {{ $classProfile->grade->name }} - Section {{ $classProfile->section }}</h2>

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
