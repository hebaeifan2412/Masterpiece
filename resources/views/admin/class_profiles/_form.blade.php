@extends('layouts.app')

@section('content')
<h2>Create Class</h2>
<form action="{{ route('class_profiles.store') }}" method="POST">
    @csrf
    <label>Grade:</label>
    <select name="grade_id">
        @foreach($grades as $grade)
        <option value="{{ $grade->id }}">{{ $grade->name }}</option>
        @endforeach
    </select>

    <label>Section:</label>
    <select name="section">
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
    </select>

    <label>Capacity:</label>
    <input type="number" name="capacity" value="30" min="1">

    <button type="submit">Save</button>
</form>
@endsection
