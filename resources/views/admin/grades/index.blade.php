@extends('admin.layout.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row align-items-center mb-4">
        <div class="col-md-6">
            <h2 class="mb-0 text-dark fw-bold">Grades Management</h2>
        </div>
        <div class="col-md-6 text-md-end">
            <a href="{{ route('admin.grades.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i> Create New Grade
            </a>
        </div>
    </div>


    @if($grades->isEmpty())
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center py-5">
                <i class="fas fa-graduation-cap fa-4x text-muted mb-4"></i>
                <h4 class="text-muted mb-3">No grades found</h4>
                <a href="{{ route('admin.grades.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i> Create New Grade
                </a>
            </div>
        </div>
    @else
        <div class="row g-4">
            @foreach($grades as $grade)
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h5 class="card-title mb-0 fw-bold text-primary">{{ $grade->name }}</h5>
                            <span class="badge bg-primary  text-light">
                                {{ $grade->class_profiles_count ?? 0 }} classes
                            </span>
                        </div>
                        <p class="text-muted mb-4">
                            <small>
                                <i class="far fa-calendar-alt me-2"></i>
                                Created: {{ $grade->created_at->format('M d, Y') }}
                            </small>
                        </p>
                    </div>
                    <div class="card-footer bg-transparent border-top-0 pt-0 pb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group w-100 gap-1">  <!-- Added gap-1 for spacing between buttons -->
                                <a href="{{ route('admin.grades.class_profiles', $grade->id) }}" 
                                   class="btn btn-primary btn-sm rounded-start-pill px-3"
                                   data-bs-toggle="tooltip" title="View Classes">
                                    <i class="fas fa-layer-group me-1"></i> Classes
                                </a>
                                <a href="{{ route('admin.grades.edit', $grade->id) }}" 
                                   class="btn btn-secondary text-light btn-sm px-3"
                                   data-bs-toggle="tooltip" title="Edit">
                                    <i class="fas fa-edit me-1"></i> Edit
                                </a>
                                <form action="{{ route('admin.grades.destroy', $grade->id) }}" method="POST" class="d-inline flex-grow-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn ld  btn-sm rounded-end-pill w-100"
                                            data-bs-toggle="tooltip" title="Delete"
                                            onclick="return confirm('Are you sure you want to delete this grade?')">
                                        <i class="fas fa-trash-alt me-1"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="d-flex flex-column align-items-center mt-4">
            <div class="mb-2 text-muted">
                Showing {{ $grades->firstItem() }} to {{ $grades->lastItem() }} of {{ $grades->total() }} results
            </div>
            {{ $grades->withQueryString()->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    });
</script>
@endsection