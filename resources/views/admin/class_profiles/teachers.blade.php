@extends('admin.layout.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>
           <i class="fa-solid fa-user-plus me-2"></i> Teachers & Subjects for:  {{ $classProfile->grade->name }} - Section {{ $classProfile->section }}
        </h2>
        <a href="{{ route('admin.class.assign-teacher', ['class' => $classProfile->id]) }}" 
           class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Assign Teacher
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            @if ($classProfile->teachers && $classProfile->teachers->count())
                <div class="table-responsive">
                    <table class="table table-hover lign-middlea ">
                        <thead class="text-light bg-primary">
                            <tr>
                                <th>Teacher</th>
                                <th>Subjects</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($classProfile->teachers as $teacher)
                                <tr>
                                    <td>
                                        {{ $teacher->user->firstname }} {{ $teacher->user->lastname }}
                                        <br>
                                        <small class="text-muted">{{ $teacher->user->email }}</small>
                                    </td>
                                    <td>
                                          @if($teacher->subject)
                                             <span>{{ $teacher->subject->name }}</span>
                                        @else
                                            <span class="text-muted">No subject assigned</span>
                                         @endif
                                           
                                    </td>
                                    <td>
                                         <form method="POST" action="{{ route('admin.class.assign-teacher.unassign', [$classProfile->id, $teacher->id]) }}">
                                @csrf
                                @method('DELETE')
                                  <button type="button" class="btn btn-sm bg-light-red text-light unassign-btn">
                                   <i class="fas fa-user-minus"></i>
                                </button>
                            </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-primary">
                    <i class="fas fa-info-circle me-2"></i> No teachers have been assigned to this class yet.
                </div>
            @endif
        </div>
    </div>
    <a href="{{ route('admin.grades.class_profiles', ['grade' => $classProfile->grade->id]) }}" class="btn btn-secondary text-light me-2 mt-4 float-end">
                <i class="fas fa-arrow-left me-1"></i> 
            </a>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const buttons = document.querySelectorAll('.unassign-btn');

        buttons.forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('form');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "This will unassign the teacher from the class.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#F3797E',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, unassign',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endsection