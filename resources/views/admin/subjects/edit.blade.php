@extends('admin.layout.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4 p-5">
        <h2 class="text-center text-primary mb-4">Edit Subject</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.subjects.update', $subject->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group mb-4">
                <label class="font-weight-bold text-dark">Subject Name</label>
                <input type="text" name="name" value="{{ old('name', $subject->name) }}" class="form-control shadow-sm" required>
            </div>

            <div class="form-group mb-4">
                <label class="font-weight-bold text-dark">Subject Code</label>
                <input type="text" name="code" value="{{ old('code', $subject->code) }}" class="form-control shadow-sm" required>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-warning btn-lg w-50">Update Subject</button>
            </div>
        </form>
    </div>
</div>
@endsection
