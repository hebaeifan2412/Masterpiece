@extends('admin.layout.app')


@section('content')
<div class="container">
    <h2>Add New Student</h2>
    <form method="POST" action="{{ route('admin.students.store') }}">
        @include('admin.students.partials.form', ['buttonText' => 'Create'])
    </form>
</div>
@endsection
