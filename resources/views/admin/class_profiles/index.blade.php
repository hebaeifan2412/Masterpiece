@extends('admin.layout.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0 fw-bold text-dark">  <i class="fas fa-layer-group me-1"></i> Class for  {{ $grade->name }}</h2>
        <a href="{{ route('admin.class_profiles.create',  ['grade' => $grade->id]) }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i> Add New Class
        </a>
    </div>


    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-primary text-light">
                        <tr>
                            <th class="ps-4">#</th>
                            <th>Section</th>
                            <th>Capacity</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($grade->classProfiles as $profile)
                        <tr>
                            <td class="ps-4 fw-medium">{{ $loop->iteration }}</td>
                            <td>{{ $profile->section }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="progress flex-grow-1 me-2" style="height: 6px;">
                                        @php
                                            $capacityPercentage = $profile->capacity > 0 ? ($profile->students_count / $profile->capacity) * 100 : 0;
                                        @endphp
                                        <div class="progress-bar bg-{{ $capacityPercentage > 90 ? 'danger' : ($capacityPercentage > 70 ? 'warning' : 'success') }}" 
                                             role="progressbar" 
                                             style="width: {{ $capacityPercentage }}%" 
                                             aria-valuenow="{{ $capacityPercentage }}" 
                                             aria-valuemin="0" 
                                             aria-valuemax="100">
                                        </div>
                                    </div>
                                    <small>{{ $profile->students_count }}/{{ $profile->capacity }}</small>
                                </div>
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                     <!-- View Teachers & Subjects -->
        <a href="{{ route('admin.class_profiles.teachers', $profile->id) }}" 
            class="btn btn-sm btn-primary-soft text-primary a rounded-circle "
            
            title="Teachers & Subjects">
             <i class="fas fa-chalkboard-teacher "></i>
         </a>
 
         <!-- View Students -->
         <a href="{{ route('admin.class_profiles.students', $profile->id) }}" 
            class="btn btn-sm btn-b-soft   rounded-circle"
            title="View Students">
             <i class="fas fa-users"></i>
         </a>
 
                                    <a href="{{ route('admin.class_profiles.edit', $profile->id) }}" 
                                       class="btn btn-sm btn-secondary-soft  text-secondary rounded-circle"
                                       title="Edit">
                                        <i class="fas fa-edit a"></i>
                                    </a>
                                    <form id="delete-class-form-{{ $profile->id }}" action="{{ route('admin.class_profiles.destroy', $profile->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" 
                                                class="btn btn-sm btn-c-soft  rounded-circle"
                                                title="Delete"
                                                onclick="confirmClassDelete({{ $profile->id }})">
                                              <i class="fas fa-trash-alt c"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">
                                <i class="fas fa-chalkboard fa-2x mb-3"></i>
                                <p class="mb-0">No class profiles found for this grade.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
                   </div>
    </div>
     <a href="{{ route('admin.grades.index') }}" class="btn btn-secondary text-light me-2 mt-4 float-end">
                <i class="fas fa-arrow-left me-1"></i> 
            </a>
</div>

@endsection
@push('scripts')
<script>
function confirmClassDelete(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You are about to delete this class.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#F3797E',
        cancelButtonColor: '#aaa',
        confirmButtonText: 'Yes, delete it'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-class-form-' + id).submit();
        }
    });
}
</script>

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Cannot Delete Class',
        text: "{{ session('error') }}"
    });
</script>
@endif
@endpush
