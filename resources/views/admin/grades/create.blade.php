@extends('admin.layout.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow p-5 rounded-4">
        <h2 class="text-primary text-center mb-4">Add New Grade</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Oops!</strong> Please fix the errors:
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.grades.store') }}">
            @csrf
            <div class="form-group mb-4">
                <label for="name" class="text-dark fw-bold">Grade Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control shadow-sm" required>
            </div>
            <div class="form-group text-center mt-4">
                <button type="submit" class="btn btn-primary px-5">Create</button>
                <a href="{{ route('admin.grades.index') }}" class="btn btn-secondary ms-2">Back</a>
            </div>
        </form>
    </div>
</div>
@endsection
