@extends('admin.layout.app')

@section('content')

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0 fw-bold text-dark"><i class="fa-solid fa-book"></i> All Subjects</h2>
            <a href="{{ route('admin.subjects.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i> Add New Subject
            </a>
        </div>
    
      
    
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-primary text-light">
                            <tr>
                                <th class="ps-4">#</th>
                                <th>Subject Name</th>
                                <th>Subject Code</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($subjects as $subject)
                            <tr>
                                <td class="ps-4 fw-medium">{{ $loop->iteration }}</td>
                                <td>{{ $subject->name }}</td>
                                <td>
                                    <span class="badge bg-light text-dark">{{ $subject->code }}</span>
                                </td>
                                <td class="text-end pe-4">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('admin.subjects.edit', $subject->id) }}" 
                                           class="btn btn-sm btn-secondary-soft text-secondary rounded-circle"
                                           title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                      <form action="{{ route('admin.subjects.destroy', $subject->id) }}" method="POST" id="delete-subject-form-{{ $subject->id }}" class="d-inline">
    @csrf
    @method('DELETE')
    <button type="button" 
            class="btn btn-sm btn-c-soft text-c rounded-circle delete-subject-btn"
            title="Delete"
            data-form-id="delete-subject-form-{{ $subject->id }}">
        <i class="fas fa-trash-alt"></i>
    </button>
</form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">
                                    <i class="fas fa-book-open fa-2x mb-3"></i>
                                    <p class="mb-0">No subjects found.</p>
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
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.delete-subject-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const formId = this.getAttribute('data-form-id');
            const form = document.getElementById(formId);
            
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#F3797E',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
</script>
@endpush