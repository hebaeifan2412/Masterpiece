@extends('admin.layout.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-primary mb-4">Edit Teacher Profile</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.teacher_profiles.update', $teacherProfile->id) }}" enctype="multipart/form-data">
        @csrf @method('PUT')

        @include('admin.teachers._form', ['users' => $users, 'teacher_profile' => $teacherProfile])

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
