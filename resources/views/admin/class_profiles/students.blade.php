@extends('admin.layout.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="page-header d-flex justify-content-between align-items-center">
                <h2 class="mb-0">
                    <i class="fas fa-users me-2"></i>
                    Students in Class: {{ $classProfile->grade->name }} - Section {{ $classProfile->section }}
                </h2>
                <a href="{{ route('admin.class_profiles.students.pdf', $classProfile->id) }}" class="btn btn-primary">
                    <i class="fas fa-file-pdf me-1"></i> Download PDF
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary ">
                    <h5 class="card-title mb-0 text-light">Student List</h5>
                </div>
                <div class="card-body p-0">
                    @if($classProfile->students->isNotEmpty())
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Full Name</th>
                                        <th>National ID</th>
                                        <th>Gender</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Date of Birth</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($classProfile->students as $index => $student)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>
                                                <strong>{{ $student->user->firstname }} {{ $student->user->lastname }}</strong>
                                                @if($student->user->secname || $student->user->thirdname)
                                                    <small class="text-muted d-block">
                                                        {{ $student->user->secname }} {{ $student->user->thirdname }}
                                                    </small>
                                                @endif
                                            </td>
                                            <td>{{ $student->national_id ?? '-' }}</td>
                                            <td>
                                                <span class="badge bg-{{ $student->gender == 'male' ? 'primary' : 'info' }}">
                                                    {{ ucfirst($student->gender ?? '-') }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="mailto:{{ $student->user->email }}" class="text-decoration-none">
                                                    {{ $student->user->email ?? '-' }}
                                                </a>
                                            </td>
                                            <td>{{ $student->user->phone ?? '-' }}</td>
                                            <td>
                                                @if($student->date_of_birth)
                                                    {{ \Carbon\Carbon::parse($student->date_of_birth)->format('M d, Y') }}
                                                    <small class="text-muted d-block">
                                                        (Age: {{ \Carbon\Carbon::parse($student->date_of_birth)->age }})
                                                    </small>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="p-4 text-center">
                            <div class="py-5">
                                <i class="fas fa-user-graduate fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">No students enrolled in this class</h5>
                                <p class="text-muted">There are currently no students assigned to this class profile.</p>
                            </div>
                        </div>
                    @endif
                </div>
                
                @if($classProfile->students->isNotEmpty())
                    <div class="card-footer bg-light">
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                Showing {{ $classProfile->students->count() }} students
                            </small>
                            {{-- <a href="{{ route('admin.class_profiles.students.pdf', $classProfile->id) }}" class="btn btn-sm btn-success">
                                <i class="fas fa-file-pdf me-1"></i> Download PDF
                            </a> --}}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
    .card {
        border-radius: 10px;
        overflow: hidden;
        border: none;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);
    }
    
    .table thead th {
        border-bottom: 2px solid #e9ecef;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
        background-color: #f8f9fa;
    }
    
    .table tbody tr:hover {
        background-color: #f8f9fa;
    }
    
    .badge {
        font-weight: 500;
        padding: 0.35em 0.65em;
        font-size: 0.75em;
    }
    
    .page-header {
        padding: 15px 0;
        border-bottom: 1px solid #e9ecef;
    }
</style>
@endpush