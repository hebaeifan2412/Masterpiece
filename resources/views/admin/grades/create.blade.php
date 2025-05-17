@extends('admin.layout.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow p-5 rounded-4">
        <h2 class="text-primary text-center mb-4"> New Grade</h2>

       
        <form method="POST" action="{{ route('admin.grades.store') }}">
            @csrf
            <div class="form-group mb-4">
                <label for="name" class="text-dark fw-bold">Grade Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control shadow-sm" required>
            </div>
            <div class="form-group text-center mt-4">
                <button type="submit" class="btn btn-primary px-5">  <i class="fas fa-save me-1"></i> Create</button>
                <a href="{{ route('admin.grades.index') }}" class="btn btn-secondary text-light ms-2">  
                       <i class="fas fa-arrow-left me-1"></i> </a>
            </div>
        </form>
    </div>
</div>
@endsection
