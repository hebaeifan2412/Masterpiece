@extends('admin.layout.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0 fw-bold text-dark">Students Management</h2>
       
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-primary text-light">
                        <tr>
                            <th class="ps-4">National ID</th>
                            <th>Full Name</th>
                            <th>Gender</th>
                            <th>Status</th>
                            <th>Class</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td class="ps-4 fw-medium">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-xs bg-primary-soft text-primary rounded-circle me-2 d-flex align-items-center justify-content-center">
                                            <i class="fas fa-user fa-xs"></i>
                                        </div>
                                        <div>
                                            {{ $student->national_id }}
                                        </div>
                                    </div></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        
                                        <div>
                                            {{ $student->user->firstname }} {{ $student->user->secname }}
                                            {{ $student->user->thirdname }} {{$student->user->lastname }}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $student->gender == 'male' ? 'info' : 'pink' }}-soft text-{{ $student->gender == 'male' ? 'info' : 'pink' }}">
                                        {{ ucfirst($student->gender) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $student->student_status == 'active' ? 'success' : 'secondary' }}-soft text-{{ $student->student_status == 'active' ? 'success' : 'secondary' }}">
                                        {{ ucfirst($student->student_status) }}
                                    </span>
                                </td>
                                <td>
                                    @if($student->classProfile)
                                        <span class="badge text-dark">
                                            {{ $student->classProfile->grade->name ?? '' }} {{ $student->classProfile->section ?? '' }}
                                        </span>
                                    @else
                                        <span class="text-muted">Not assigned</span>
                                    @endif
                                </td>
                                <td class="text-end pe-4">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('admin.students.show', $student->national_id) }}" 
                                           class="btn btn-sm btn-primary-soft text-primary rounded-circle"
                                           title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.students.edit', $student->national_id) }}" 
                                           class="btn btn-sm btn-warning-soft text-warning rounded-circle"
                                           title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        {{-- <form action="{{ route('admin.students.destroy', $student->national_id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-danger-soft text-danger rounded-circle"
                                                    title="Delete"
                                                    onclick="return confirm('Are you sure you want to delete this student?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form> --}}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection