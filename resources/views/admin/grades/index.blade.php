@extends('admin.layout.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0 fw-bold text-dark">Grades List</h2>
        <a href="{{ route('admin.grades.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i> Add Grade
        </a>
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
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">#</th>
                            <th>Grade Name</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($grades as $index => $grade)
                        <tr>
                            <td class="ps-4 fw-medium">{{ $index + 1 }}</td>
                            <td>{{ $grade->name }}</td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.grades.edit', $grade->id) }}" 
                                       class="btn btn-sm btn-warning-soft text-warning rounded-circle"
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.grades.destroy', $grade->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-danger-soft text-danger rounded-circle"
                                                title="Delete"
                                                onclick="return confirm('Are you sure you want to delete this grade?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-4 text-muted">
                                <i class="fas fa-layer-group fa-2x mb-3"></i>
                                <p class="mb-0">No grades found.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
