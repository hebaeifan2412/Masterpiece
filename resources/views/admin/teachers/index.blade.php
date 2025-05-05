@extends('admin.layout.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0 fw-bold text-dark">Teacher Management</h2>
        <a href="{{ route('admin.teacher_profiles.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i> Add New Teacher
        </a>
    </div>

    
    <!-- Search and Filter -->
    <form method="GET" action="{{ route('admin.teacher_profiles.index') }}" class="row g-3 mb-4">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Search by name or email..." value="{{ request('search') }}">
        </div>
        <div class="col-md-4">
            <select name="subject" class="form-select" onchange="this.form.submit()">
                <option value="">subject</option>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->name }}" {{ request('subject') == $subject->name ? 'selected' : '' }}>
                        {{ ucfirst($subject->name) }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">
                <i class="fas fa-filter me-1"></i> Apply
            </button>
        </div>
        <div class="col-md-2">
            <a href="{{ route('admin.teacher_profiles.index') }}" class="btn btn-secondary w-100">
                <i class="fas fa-sync-alt me-1"></i> Reset
            </a>
        </div>
    </form>

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
                            <th class="ps-4">#</th>
                            <th>Username</th>
                            <th>Subject</th>
                            <th>Email</th>
                            {{-- <th>Date of Birth</th> --}}
                            <th>Joining Date</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($teachers as $profile)
                        <tr>
                            <td class="ps-4 fw-medium">{{ $profile->id }}</td>
                            <td>{{ $profile->user->firstname }} {{ $profile->user->secname }}
                                {{ $profile->user->thirdname }} {{$profile->user->lastname }}</td>
                            <td>{{ $profile->subject->name }}</td>
                            <td>
                                {{ $profile->user->email }}
                            </td>
                            {{-- <td>{{ $profile->dob }}</td> --}}
                            <td>{{ $profile->joining_date }}</td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.teacher_profiles.show', $profile->id) }}" 
                                        class="btn btn-sm btn-primary-soft text-primary rounded-circle"
                                        title="View Details">
                                         <i class="fas fa-eye"></i>
                                     </a>
                                    {{-- <a href="{{ route('admin.teacher_profiles.edit', $profile->id) }}" 
                                       class="btn btn-sm btn-warning-soft text-warning rounded-circle"
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a> --}}
                                    <form action="{{ route('admin.teacher_profiles.destroy', $profile->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-danger-soft text-danger rounded-circle"
                                                title="Delete"
                                                onclick="return confirm('Are you sure you want to delete this teacher profile?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                <i class="fas fa-chalkboard-teacher fa-2x mb-3"></i>
                                <p class="mb-0">No teacher profiles found.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
           
        </div>
    </div>
   
</div>

<div class="d-flex flex-column align-items-center mt-4">
    <div class="mb-2 text-muted ">
        Showing {{ $teachers->firstItem() }} to {{ $teachers->lastItem() }} of {{ $teachers->total() }} results
    </div>

    {{ $teachers->withQueryString()->links('pagination::bootstrap-5') }}
</div>
@endsection