@extends('admin.layout.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4 p-5">
        <h2 class="text-center text-primary mb-4">Subject Details</h2>

        <div class="mb-3">
            <strong>Name:</strong> {{ $subject->name }}
        </div>
        <div class="mb-3">
            <strong>Code:</strong> {{ $subject->code }}
        </div>

        <a href="{{ route('admin.subjects.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
</div>
@endsection
