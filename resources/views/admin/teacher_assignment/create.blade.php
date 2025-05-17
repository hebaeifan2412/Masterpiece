@extends('admin.layout.app')

@section('content')
    <div class="container py-4">
        <h3 class="mb-4">Assign Teacher to Class: {{ $classProfile->grade->name }} - Section {{ $classProfile->section }}
        </h3>


        <div class="card shadow-sm">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.class.assign-teacher.store', $classProfile->id) }}">
                    @csrf

                    <div class="mb-3">
                        <label for="subject_id" class="form-label">Choose Subject</label>
                        <select name="subject_id" id="subject_id" class="form-select" required>
                            <option value="">-- Select Subject --</option>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}"
                                    {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                                    {{ $subject->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="teacher_id" class="form-label">Choose Teacher</label>
                        <select name="teacher_id" id="teacher_id" class="form-select" required>
                            <option value="">-- Select Subject First --</option>
                        </select>
                    </div>


                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check-circle me-1"></i> Assign Teacher
                    </button>
                </form>
            </div>
        </div>
        <a href="{{ route('admin.grades.class_profiles', $classProfile->grade->id) }}"
            class="btn btn-secondary ms-5 text-light me-2 mt-4 float-end">
            <i class="fas fa-arrow-left me-1"></i>
        </a>




    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const subjectSelect = document.getElementById('subject_id');
            const teacherSelect = document.getElementById('teacher_id');
            const classId = {{ $classProfile->id }};

            subjectSelect.addEventListener('change', function() {
                const subjectId = this.value;
                teacherSelect.innerHTML = '<option value="">Loading...</option>';

                if (subjectId) {
                    fetch(`/admin/subject/${subjectId}/teachers?class_id=${classId}`)
                        .then(response => response.json())
                        .then(data => {
                            teacherSelect.innerHTML = '<option value="">-- Select Teacher --</option>';
                            data.forEach(teacher => {
                                if (teacher.user) {
                                    teacherSelect.innerHTML += `
                                <option value="${teacher.id}">
                                    ${teacher.user.firstname} ${teacher.user.lastname}
                                </option>`;
                                } else {
                                    teacherSelect.innerHTML += `
                                <option value="${teacher.id}">
                                    Unknown Teacher
                                </option>`;
                                }
                            });
                        })
                        .catch(error => {
                            console.error('Error fetching teachers:', error);
                            teacherSelect.innerHTML =
                            '<option value="">Error loading teachers</option>';
                        });
                } else {
                    teacherSelect.innerHTML = '<option value="">-- Select Subject First --</option>';
                }
            });
        });
    </script>
@endsection
